<?php

class Cart
{
    public function addDish($itemId, $itemName, $itemPicture, $quantity, $price)
    {

        if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$itemId]) && is_array($_SESSION['cart'][$itemId])) {
           
            $_SESSION['cart'][$itemId]['quantity'] += (int)$quantity; 
        } else {
            $_SESSION['cart'][$itemId] = array(
                'id' => (int)$itemId, 
                'name' => htmlspecialchars($itemName), 
                'quantity' => (int)$quantity, 
                'price' => (float)$price, 
                'pictureName' => htmlspecialchars($itemPicture) 
            );
        }
    }




    public function getTotalPrice()
    {
        $totalPrice = 0;
        foreach ($_SESSION['cart'] as $item) {
            $totalPrice += $item['quantity'] * $item['price'];
        }
        return $totalPrice;
    }

    public function removeItem($itemId)
    {
        if (isset($_SESSION['cart'][$itemId])) {
            unset($_SESSION['cart'][$itemId]);
        }
    }

    public function clearCart()
    {
        $_SESSION['cart'] = array();
    }
}