
<?php
/**
 * @file OrderFacadeImpl.php
 * @brief Реалізація інтерфейсу OrderFacade для управління замовленнями.
 */

/**
 * @class OrderFacadeImpl
 * @brief Клас OrderFacadeImpl реалізує методи для управління замовленнями та їх обробки.
 */
class OrderFacadeImpl implements OrderFacade
{
    /**
     * @var OrderModel Модель для роботи з замовленнями.
     */
    private $orderModel;

    /**
     * @var PaymentProcessor Процесор для обробки платежів.
     */
    private $paymentProcessor;

    /**
     * @brief Конструктор класу OrderFacadeImpl.
     * 
     * Ініціалізує моделі замовлень та процесор платежів з використанням заданих ключів.
     */
    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->paymentProcessor = new PaymentProcessor(PUBLIC_KEY, PRIVATE_KEY);
    }

    /**
     * @brief Оформлює нове замовлення.
     * 
     * Розраховує загальну суму замовлення, додає замовлення в базу даних і обробляє платіж.
     * 
     * @param array $dataOrder Дані замовлення.
     * @param array $cartItems Елементи кошика.
     * @return bool Результат оформлення замовлення (true - успіх, false - невдача).
     */
    public function placeOrder($dataOrder, $cartItems)
    {
        $totalAmount = $this->calculateTotalAmount($cartItems);
        $dataOrder['sum'] = $totalAmount;
        $order_id = $this->orderModel->addOrder($dataOrder, $cartItems);

        $paymentResult = $this->paymentProcessor->processPayment($order_id, $totalAmount, true);

        if (!$paymentResult) {
            return false;
        }
        
        return true;
    }

    /**
     * @brief Отримує замовлення користувача.
     * 
     * @param int $userId Ідентифікатор користувача.
     * @return array Список замовлень користувача.
     */
    public function getOrdersOfTheUser($userId)
    {
        return $this->orderModel->getOrdersOfTheUser($userId);
    }

    /**
     * @brief Розраховує загальну суму замовлення.
     * 
     * @param array $cartItems Елементи кошика.
     * @return float Загальна сума замовлення.
     */
    private function calculateTotalAmount($cartItems)
    {
        $total = 0;
        foreach ($cartItems as $item) {
            $total +=  floatval($item['price']) * floatval($item['quantity']);
        }
        return $total;
    }
}
