<?php


class Checkout extends Controller{

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

                $data['phone'] = $_POST['phone'];
                $data['address'] = $_POST['address'];
                $data['city'] = $_POST['city'];
                $data['state'] = $_POST['state'];

                
            }
            $this->view('add-review');
        }
    }


}