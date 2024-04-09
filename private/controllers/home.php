


<?php

class Home extends Controller
{

    function index()
    {
        $categoryModel = new CategoryModel();
        $dishModel = new DishModel();
        $dishes = $dishModel->getAllDishes();
        $categories = $categoryModel->getAllCategories();
        if (count($_POST) > 0) {
            $cart = new Cart();
            $dish = $dishModel->findDish($dishes, $_POST['idDish']);
            $quantity = 1;
            $cart->addDish($dish->id, $dish->name, $dish->picture, $quantity, $dish->price);
            header("Location: " . $_SERVER['REQUEST_URI']);
        }

        $this->view('home', ['allCategories' => $categories, 'allDishes' => $dishes]);
    }


}
