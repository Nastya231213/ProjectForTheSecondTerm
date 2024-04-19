
<?php
class OrderFacadeImpl implements OrderFacade
{
    private $orderModel;
    private $paymentProcessor;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->paymentProcessor = new PaymentProcessor(PUBLIC_KEY, PRIVATE_KEY);
    }

    public function placeOrder($dataOrder, $cartItems)
    {
        $totalAmount = $this->calculateTotalAmount($cartItems);
        $dataOrder['sum']=$totalAmount;
        $order_id=$this->orderModel->addOrder($dataOrder, $cartItems);

        $paymentResult = $this->paymentProcessor->processPayment($order_id, $totalAmount,true);

        if (!$paymentResult) {
            return false;
        }
        
        return true;
    }

    public function getOrdersOfTheUser($userId)
    {
        return $this->orderModel->getOrdersOfTheUser($userId);
    }

    private function calculateTotalAmount($cartItems)
    {
        $total = 0;
        foreach ($cartItems as $item) {
            $total +=  floatval($item['price']) * floatval($item['quantity']);
        }
        return $total;
    }
}
