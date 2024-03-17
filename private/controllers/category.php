<?php

class Category extends Controller
{

    function index()
    {

        if (!isAdmin()) {
            $this->redirect('home');
        } else {
            $data = array();
            $data = addMessage($data);
            $categoryModel = new CategoryModel();
            $data['allCategories'] = $categoryModel->getAllCategories();

            $this->view('admin/categories', $data);
        }
    }


    function add()
    {
        if (count($_POST) > 0) {
            $categoryModel = new CategoryModel();
            $name = $_POST['name'];
            $description = $_POST['description'];
            if ($categoryModel->addCategory($name, $description)) {
                $_SESSION['successMessage'] = 'The category has been added';
            } else {
                $_SESSION['errorMessage'] = 'Something goes wrong..The category has not been added';
            }
            $this->redirect('category');
        }
        $this->view('admin/add-category');
    }
}
