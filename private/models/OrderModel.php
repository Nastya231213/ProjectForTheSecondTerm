<?php

/**
 * @file OrderModel.php
 * Клас OrderModel
 * @class OrderModel.php
 * @brief Представляє модель для управління замовленнями у програмі.
 */

class OrderModel extends Model
{
    /** @var string $tableName Назва таблиці замовлень. */
    private $tableName = "orders__";

    /**
     * Додає нове замовлення до бази даних.
     *
     * @param array $data Дані для нового замовлення.
     * @return int ID вставленого замовлення.
     */
    function addOrder($data)
    {
        $result = $this->insert($this->tableName, $data);
        if ($result) {
            $cart_items = $_SESSION['cart'];
            $dataOfItem['order_id'] = $this->getLastInsertedId();
            foreach ($cart_items as $item) {
                $dataOfItem['user_id'] = $data['user_id'];
                $dataOfItem['product_id'] = $item['id'];
                $dataOfItem['quantity'] = $item['quantity'];
                $dataOfItem['type'] = $item['type'];
                $this->addItemOfOrder($dataOfItem);
            }
        }
        return $dataOfItem['order_id'];
    }

    /**
     * Видаляє замовлення з бази даних.
     *
     * @param int $id ID замовлення для видалення.
     * @return bool Результат видалення (true - успішно, false - невдало).
     */
    function deleteOrder($id)
    {
        return $this->delete($this->tableName, ['id' => $id]);
    }

    /**
     * Отримує замовлення користувача з бази даних.
     *
     * @param int $id ID користувача.
     * @return array|null Масив замовлень або null, якщо замовлень немає.
     */
    function getOrdersOfTheUser($id)
    {
        $this->select($this->tableName, ['user_id' => $id]);
        return $this->resultset();
    }

    /**
     * Отримує останній вставлений ID з таблиці замовлень.
     *
     * @return int Останній вставлений ID.
     */
    function getLastInsertedId()
    {
        $sql = "SELECT LAST_INSERT_ID() AS last_id FROM $this->tableName";
        $this->query($sql);
        return $this->single()->last_id;
    }

    /**
     * Додає товар до замовлення у таблицю замовлень.
     *
     * @param array $data Дані товару для додавання.
     */
    function addItemOfOrder($data)
    {
        $tableName = "order_item_";
        $this->insert($tableName, $data);
    }

    /**
     * Оновлює статус замовлення в таблиці замовлень.
     *
     * @param int $order_id ID замовлення для оновлення.
     * @return bool Результат оновлення (true - успішно, false - невдало).
     */
    function updateStatus($order_id)
    {
        return $this->update($this->tableName, ['status' => true], ['id' => $order_id]);
    }
}
