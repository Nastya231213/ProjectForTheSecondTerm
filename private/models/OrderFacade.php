<?php 


interface OrderFacade{
    public function placeOrder($data,$cartItems);
    public function getOrdersOfTheUser($userId);
}