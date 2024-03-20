<?php


class Logout extends Controller{
    function index(){

        unset($_SESSION['user']);


        $this->redirect('login');
    }
}