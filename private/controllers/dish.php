<?php


class Dish extends Controller
{

    function index()
    {

        if (!isAdmin()) {
            $this->redirect('home');
        } else {
            $data = array();
            $data = addMessage($data);
            $dishModel = new DishModel();
            $data['allDishes'] = $dishModel->getAllDishes();

            $this->view('admin/dishes', $data);
        }
    }

    function add()
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

    function edit($id)
    {
        $dishModel = new DishModel();

        if (count($_POST) > 0) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $category_id = $_POST['category'];

            if ($dishModel->editDish($id, $name, $description, $category_id)) {
                $_SESSION['successMessage'] = 'The category has been updated';
            } else {
                $_SESSION['errorMessage'] = 'Something goes wrong..The category has not been updated';
            }
            $this->redirect('category');
        } else {
            $categoryModel = new CategoryModel();
            $data['allCategories'] = $categoryModel->getAllCategories();
            $data['dish'] = $dishModel->getDish($id);
            $this->view('admin/edit-dish', $data);
        }
    }
}
