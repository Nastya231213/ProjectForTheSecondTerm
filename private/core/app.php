<?php

/**
 * @file
 * Код класу App, який ініціалізує додаток та обробляє маршрутизацію запитів.
 */

/**
 * @class App
 * @brief Клас, який ініціалізує додаток та обробляє маршрутизацію запитів.
 */
class App
{
    protected $currentController = "home"; ///< string Поточний контролер за замовчуванням.
    protected $method = "index"; ///< string Метод контролера за замовчуванням.
    protected $params = array(); ///< array Параметри запиту.

    /**
     * Отримати URL та розібрати його на частини.
     *
     * @return array Повертає масив рядків, які представляють різні частини URL.
     */
    private function getURL()
    {
        $url = $_GET['url'] !== '' ? $_GET['url'] : "home";
        return explode("/", filter_var(trim($url), FILTER_SANITIZE_URL));
    }

    /**
     * Конструктор класу App.
     *
     * Ініціалізує об'єкт контролера згідно URL та викликає відповідний метод з параметрами.
     */
    function __construct()
    {
        $URL = $this->getURL();

        if (file_exists("../private/controllers/" . $URL[0] . ".php")) {
            $this->currentController = ucfirst($URL[0]);
            unset($URL[0]);
            require "../private/controllers/" . $this->currentController . ".php";
        } else {
            if (!isset($URL[1])) {
                require "../private/controllers/" . $this->currentController . ".php";

                if (method_exists($this->currentController, $URL[0])) {
                    $this->method = $URL[0];
                    unset($URL[0]);
                }
            } else {
                echo "<center><h3>controller not found</h3></center>";
                die;
            }
        }

        $this->currentController = new $this->currentController();
        if (isset($URL[1])) {
            if (method_exists($this->currentController, $URL[1])) {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }

        $URL = array_values($URL);
        $this->params = $URL;

        call_user_func_array([$this->currentController, $this->method], $this->params);
    }
}

