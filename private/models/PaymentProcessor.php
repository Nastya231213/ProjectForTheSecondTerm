<?php

require_once 'LiqPay.php';

/**
 * @file
 * @brief Файл, що містить клас PaymentProcessor для обробки платежів через LiqPay.
 */

/**
 * @class PaymentProcessor
 * 
 * @brief Клас для обробки платежів через LiqPay.
 */
class PaymentProcessor
{
    /** @var LiqPay $liqpay Об'єкт LiqPay для взаємодії з платіжною системою. */
    private $liqpay;

    /** @var string $publicKey Публічний ключ LiqPay. */
    private $publicKey;

    /** @var string $privateKey Приватний ключ LiqPay. */
    private $privateKey;

    /**
     * Конструктор класу PaymentProcessor.
     *
     * @param string $publicKey Публічний ключ LiqPay.
     * @param string $privateKey Приватний ключ LiqPay.
     */
    public function __construct($publicKey, $privateKey)
    {
        $this->publicKey = $publicKey;
        $this->privateKey = $privateKey;

        $this->liqpay = new LiqPay($publicKey, $privateKey);
    }

    /**
     * Метод для обробки платежу.
     *
     * @param int $order_id ID замовлення.
     * @param float $totalAmount Загальна сума платежу.
     * @param bool $isMoveOn Опціональний параметр. Якщо true, форма автоматично відправиться для оплати.
     */
    public function processPayment($order_id, $totalAmount, $isMoveOn = false)
    {
        $params = [
            'public_key' => $this->publicKey,
            'action'         => 'pay',
            'amount'         => $totalAmount,
            'currency'       => 'USD',
            'description'    => 'Pay for products',
            'order_id'       => 'order_'.$order_id.rand(1,9999),
            'version'        => '3',
            'result_url' => 'http://localhost/QuickCuisine/public/order/payment?order_id='.$order_id,
            'id' => $order_id
        ];

        $data = base64_encode(json_encode($params));

        $signString = $this->privateKey . $data . $this->privateKey;
        $signature = base64_encode(sha1($signString, true));
        
        echo '<form id="paymentForm" method="POST" action="https://www.liqpay.ua/api/3/checkout" accept-charset="utf-8">';
        echo '<button type="submit" class="btn btn-sm btn-success"> Pay online <i class="fas fa-money-check"></i> </button>';
        echo '<input type="hidden" name="data" value="' . $data . '">';
        echo '<input type="hidden" name="signature" value="' . $signature . '">';
        echo '</form>';

        if ($isMoveOn) {
            echo '<script>document.getElementById("paymentForm").submit();</script>';
        }
    }

    /**
     * Метод для обробки відповіді від платіжної системи.
     *
     * @param array $data Масив даних, отриманих від LiqPay.
     * @return bool Результат перевірки успішності платежу.
     */
    public function handlePaymentResponse($data)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST['data'];
            $receivedSignature = $_POST['signature'];

            $decodedData = json_decode(base64_decode($data), true);
            $checkSignature = base64_encode(sha1($this->privateKey . $data . $this->privateKey, true));

            if ($checkSignature == $receivedSignature && $decodedData['status'] == 'success') {
                return true;
            }
        }
        return false;
    }
}
