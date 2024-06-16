<?php
/**
 * @file
 * Logout.php
 *
 */

/**
 * @class Logout
 * @brief Клас, що відповідає за вихід з акаунту користувача.
 *
 * Клас Logout розширює базовий клас контролера Controller.
 */
class Logout extends Controller
{
    /**
     * @brief Вихід користувача з системи.
     *
     * Цей метод видаляє змінні сесії 'user' і 'cart', що реалізує вихід користувача з системи.
     */
    function index()
    {
        unset($_SESSION['user']);
        unset($_SESSION['cart']);

        $this->redirect('login');
    }
}
