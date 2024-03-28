


<?php

class Home extends Controller{

    function index()
    {
        $categoryModel=new CategoryModel();
        $dishModel=new DishModel();
        $dishes=$dishModel->getAllDishes();
        $categories=$categoryModel->getAllCategories();
        $this->view('home',['allCategories'=>$categories,'allDishes'=>$dishes]);
        
    }
 
}