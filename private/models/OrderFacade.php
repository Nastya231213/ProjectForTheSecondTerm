<?php 

/**
 * @file OrderFacade.php
 * @brief Інтерфейс для управління замовленнями.
 */

/**
 * @interface OrderFacade
 * @brief Інтерфейс для класів, що реалізують управління замовленнями.
 * 
 * Включає методи для оформлення замовлень та отримання замовлень користувача.
 */
interface OrderFacade
{
    /**
     * @brief Оформлює нове замовлення.
     * 
     * @param array $data Дані замовлення.
     * @param array $cartItems Елементи кошика.
     * @return mixed Результат операції оформлення замовлення.
     */
    public function placeOrder($data, $cartItems);

    /**
     * @brief Отримує замовлення користувача.
     * 
     * @param int $userId Ідентифікатор користувача.
     * @return array Список замовлень користувача.
     */
    public function getOrdersOfTheUser($userId);
}
