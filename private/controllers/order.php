<?php


class Order extends Controller{

    function index(){
        if (! isLoggedIn()) {
            $this->redirect('home');
        } else {
           
            $this->view('checkout');
        }
    }
    function add(){


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
                $data['user_id']=$_SESSION['user']->id;

                $data['form_payment'] = $_POST['formPayment'];

                $orderModel= new OrderModel();
                $orderModel->addOrder($data);
            }
            $this->view('add-review');
        }
    }
    function display_your_orders(){
        if (!isLoggedIn()) {

            $this->redirect('login');
        }else{
            $orderModel= new OrderModel();
            $currentUserId=$_SESSION['user']->id;
            $orders=$orderModel->getOrdersOfTheUser($currentUserId);
        }
        $this->view('orders',['yourOrders'=>$orders]);
    }



}