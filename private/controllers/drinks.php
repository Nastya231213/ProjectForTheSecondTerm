<?php


class Drinks extends Controller
{

    function index()
    {

        if (!isAdmin()) {
            $this->redirect('home');
        } else {
            $data = array();
            $data = addMessage($data);
            $dishModel = new DrinksModel();
            $data['allDrinks'] = $dishModel->getDrinks();
            $this->view('admin/drinks', $data);
        }
    }

    function add()
    {
        if (count($_POST) > 0) {
            $drinkModel = new DrinksModel();
            $name = $_POST['name'];
            $description = $_POST['description'];
            $composition = $_POST['composition'];
            $category_id = $_POST['category'];
            $volume = $_POST['volume'];
            $price = $_POST['price'];
            if ($drinkModel->addDrink($name, $description, $composition, $category_id, $price, $volume)) {
                $_SESSION['successMessage'] = 'The dish has been added';
            } else {
                $_SESSION['errorMessage'] = 'Something goes wrong..The dish has not been added';
            }
            $this->redirect('dish');
        }
        $categoryModel = new CategoryModel();
        $data['allCategories'] = $categoryModel->getAllCategories();
        $this->view('admin/add-drink', $data);
    }
    function edit($id)
    {
        $drinkModel = new DrinksModel();
        if (count($_POST) > 0) {
            $name = $_POST['name'];
            $composition = $_POST['composition'];
            $description = $_POST['description'];
            $category_id = $_POST['category'];
            $volume = $_POST['volume'];
            $price = $_POST['price'];

            if ($drinkModel->editDrink($id, $name, $description, $category_id, $composition, $volume, $price)) {
                $_SESSION['successMessage'] = 'The category has been updated';
            } else {
                $_SESSION['errorMessage'] = 'Something goes wrong..The category has not been updated';
            }
            $this->redirect('drinks');
        } else {

            $categoryModel = new CategoryModel();
            $data['allCategories'] = $categoryModel->getAllCategories();
            $data['drink'] = $drinkModel->getDrinks($id)[0];

            $this->view('admin/edit-drink', $data);
        }
    }
    function details($index)
    {
        $productModel = new DrinksModel();

        $product = $productModel->getDrink($index);
        $this->view('product_information', ['product' => $product]);
    }
    function delete($index)
    {
        $drinkModel = new DrinksModel();
        $drinkModel->deleteDrink($index);
        $this->view('admin/drinks');
    }
}
