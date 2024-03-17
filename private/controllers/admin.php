<?php

class Admin extends Controller
{

    function index()
    {
        if (!isAdmin()) {
            $this->redirect('home');
        } else {
            $adminName=$_SESSION['user']->name;
            $this->view('admin/dashboard',['adminName'=>$adminName]);
        }
    }
    function category()
    {

        if (!isAdmin()) {
            $this->redirect('home');
        } else {
            $this->view('admin/categories');
        }
    }


    function add_category()
    {
        $this->view('admin/add-category');
    }
}
