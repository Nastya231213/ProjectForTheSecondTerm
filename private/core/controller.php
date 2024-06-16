<?php

/**
 * @file
 * Код класу Controller, який містить методи для керування представленнями та перенаправленням.
 */

/**
 * @class Controller
 * @brief Клас Controller містить методи для керування представленнями та перенаправленням.
 */
class Controller
{
    /**
     * Відображення представлення з переданими даними.
     *
     * @param string $view Ім'я файлу представлення без розширення.
     * @param array $data Асоціативний масив даних для передачі у представлення.
     */
    function view($view, $data = array())
    {
        extract($data);

        if (file_exists("../private/views/" . $view . ".view.php")) {
            require "../private/views/" . $view . ".view.php";
        } else {
            require "../private/views/404.view.php";
        }
    }

    /**
     * Перенаправлення користувача на вказану URL-адресу.
     *
     * @param string $link URL-адреса, на яку потрібно перенаправити користувача.
     */
    public function redirect($link)
    {
        header("Location: " . ROOT . "/" . trim($link, "/"));
    }
}

?>
