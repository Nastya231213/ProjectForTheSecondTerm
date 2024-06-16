<?php
/**
 * @file
 * Cart.php
 *
 * @brief
 * Цей файл містить визначення класу Cart.
 */

/**
 * @class Cart
 *
 * @brief
 * Клас для управління кошиком покупок. Він дозволяє додавати товари до кошика, обчислювати загальну ціну, видаляти товари та очищувати кошик.
 */
class Cart
{
    /**
     * Додає товар до кошика або оновлює його кількість, якщо товар вже є в кошику.
     *
     * @param int $itemId Ідентифікатор товару.
     * @param string $itemName Назва товару.
     * @param string $itemPicture Назва файлу зображення товару.
     * @param int $quantity Кількість товару.
     * @param float $price Ціна товару.
     * @param string $type Тип товару.
     */
    public function addProduct($itemId, $itemName, $itemPicture, $quantity, $price, $type)
    {
        if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$itemId]) && is_array($_SESSION['cart'][$itemId])) {
            $_SESSION['cart'][$itemId]['quantity'] += (int)$quantity; 
        } else {
            $_SESSION['cart'][$itemId] = array(
                'id' => (int)$itemId, 
                'name' => htmlspecialchars($itemName), 
                'quantity' => (int)$quantity, 
                'price' => (float)$price, 
                'pictureName' => htmlspecialchars($itemPicture),
                'type' => $type
            );
        }
    }

    /**
     * Обчислює загальну ціну всіх товарів у кошику.
     *
     * @return float Загальна ціна товарів у кошику.
     */
    public function getTotalPrice()
    {
        $totalPrice = 0;
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $totalPrice += $item['quantity'] * $item['price'];
            }
        }
        return $totalPrice;
    }

    /**
     * Видаляє товар з кошика за його ідентифікатором.
     *
     * @param int $itemId Ідентифікатор товару, який потрібно видалити.
     */
    public function removeItem($itemId)
    {
        if (isset($_SESSION['cart'][$itemId])) {
            unset($_SESSION['cart'][$itemId]);
        }
    }

    /**
     * Очищує весь кошик, видаляючи всі товари.
     */
    public function clearCart()
    {
        $_SESSION['cart'] = array();
    }
}
