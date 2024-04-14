<?php


class Logout extends Controller
{
    function index()
    {

        unset($_SESSION['user']);
        unset($_SESSION['cart']);


        $this->redirect('login');
    }
}
