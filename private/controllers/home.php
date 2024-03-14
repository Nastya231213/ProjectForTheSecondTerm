


<?php

class Home extends Controller{

    function index()
    {
        $userModel=new UserModel();
        $this->view('home');
        
    }
 
}