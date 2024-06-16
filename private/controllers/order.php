<?php

/**
 * @file Order.php
 */ 
 /**
* @class Order
 *
 * @brief Клас Order, що відповідає за обробку замовлень користувачів.
 */
class Order extends Controller
{
    /**
     * Головна сторінка замовлень.
     *
     * Перенаправляє на домашню сторінку, якщо користувач не авторизований.
     * В іншому випадку відображає сторінку оформлення замовлення.
     *
     * @return void
     */
    function index()
    {
        if (!isLoggedIn()) {
            $this->redirect('home');
        } else {
            $this->view('checkout');
        }
    }

    /**
     * Додає нове замовлення.
     *
     * Якщо користувач не авторизований, перенаправляє на сторінку входу.
     * В іншому випадку обробляє дані форми та створює нове замовлення.
     *
     * @return void
     */
    function add()
    {
        if (!isLoggedIn()) {
            $this->redirect('login');
        } else {
            if (count($_POST) > 0) {
                $data['fullName'] = $_POST['fullName'];
                $data['email'] = $_POST['email'];
                $data['phone'] = $_POST['phoneNum'];
                $data['address'] = $_POST['address'];
                $data['city'] = $_POST['city'];
                $data['state'] = $_POST['state'];
                $data['status'] = false;
                $data['user_id'] = $_SESSION['user']->id;
                $data['form_payment'] = $_POST['formPayment'];

                $orderFacade = new OrderFacadeImpl();
                $orderFacade->placeOrder($data, $_SESSION['cart']);
            }
            $this->view('add-review');
        }
    }

    /**
     * Відображає замовлення поточного користувача.
     *
     * Якщо користувач не авторизований, перенаправляє на сторінку входу.
     * В іншому випадку отримує замовлення користувача з бази даних і відображає їх.
     *
     * @return void
     */
    function display_your_orders()
    {
        if (!isLoggedIn()) {
            $this->redirect('login');
        } else {
            $orderModel = new OrderModel();
            $currentUserId = $_SESSION['user']->id;
            $orders = $orderModel->getOrdersOfTheUser($currentUserId);
        }
        $this->view('orders', ['yourOrders' => $orders]);
    }

    /**
     * Оновлює статус замовлення на оплачений.
     *
     * Отримує ідентифікатор замовлення з параметрів запиту, оновлює його статус у базі даних і перенаправляє на сторінку замовлень користувача.
     *
     * @return void
     */
    function payment()
    {
        if (isset($_GET['order_id'])) {
            $orderModel = new OrderModel();
            $order_id = $_GET['order_id'];
            $orderModel->updateStatus($order_id);
        }
        $this->redirect('order/display_your_orders');
    }

    /**
     * Видаляє замовлення.
     *
     * Отримує ідентифікатор замовлення, видаляє його з бази даних і перенаправляє на сторінку замовлень користувача.
     *
     * @param int $id Ідентифікатор замовлення для видалення.
     * @return void
     */
    function delete($id)
    {
        $orderModel = new OrderModel();
        $result = $orderModel->delete($id);
        $this->redirect('order/display_your_orders');
    }
}
