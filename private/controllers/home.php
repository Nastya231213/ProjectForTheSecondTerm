


<?php

class Home extends Controller
{

    function index()
    {
        $categoryModel = new CategoryModel();
        $dishModel = new DishModel();
        $dishes = $dishModel->getAllDishes();
        $categoriesDishes = $categoryModel->getAllCategoriesOfDishes();
        $categoriesDrinks = $categoryModel->getAllCategoriesOfDrinks();


        $this->view('home', ['allCategoriesDishes' => $categoriesDishes, 'allCategoriesDrinks' => $categoriesDrinks, 'allDishes' => $dishes]);
    }

    function dishes()
    {
        $categoryModel = new CategoryModel();
        $dishModel = new DishModel();
        $dishes = $dishModel->getAllDishes();
        $categories = $categoryModel->getAllCategoriesOfDishes();
        if (count($_POST) > 0) {
            $cart = new Cart();
            $dish = $dishModel->findDish($dishes, $_POST['id']);
            $quantity = 1;
            $cart->addProduct($dish->id, $dish->name, $dish->picture, $quantity, $dish->price);
            header("Location: " . $_SERVER['REQUEST_URI']);
        }

        $this->view('display_products', ['allCategories' => $categories, 'allProducts' => $dishes, 'type' => 'dishes']);
    }

    function drinks()
    {
        $categoryModel = new CategoryModel();
        $drinksModel = new DrinksModel();
        $drinks = $drinksModel->getDrinks();
        $categories = $categoryModel->getAllCategoriesOfDrinks();
        if (count($_POST) > 0) {
            $cart = new Cart();
            
            $drink = $drinksModel->getDrink( $_POST['id']);
            $quantity = 1;
       
            $cart->addProduct($drink->id, $drink->name, $drink->picture, $quantity, $drink->price);
            header("Location: " . $_SERVER['REQUEST_URI']);
        }

        $this->view('display_products', ['allCategories' => $categories, 'allProducts' => $drinks, 'type' => 'drinks']);
    }
}
