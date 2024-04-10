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
            if ($drinkModel->addDrink($name, $description, $composition, $category_id, $price,$volume)) {
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
}
