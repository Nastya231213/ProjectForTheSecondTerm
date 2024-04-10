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
    function add_dish()
    {
        if (count($_POST) > 0) {
            $dishModel = new DishModel();
            $name = $_POST['name'];
            $description = $_POST['description'];
            $ingredients = $_POST['ingredients'];
            $category_id = $_POST['category'];
            $price = $_POST['price'];
            if ($dishModel->addDish($name, $description, $ingredients, $category_id, $price)) {
                $_SESSION['successMessage'] = 'The dish has been added';
            } else {
                $_SESSION['errorMessage'] = 'Something goes wrong..The dish has not been added';
            }
            $this->redirect('dish');
        }
        $categoryModel = new CategoryModel();
        $data['allCategories'] = $categoryModel->getAllCategories();
        $this->view('admin/add-dish', $data);
    }
 
}
