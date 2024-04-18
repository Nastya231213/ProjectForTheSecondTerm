


<?php

class Home extends Controller
{

    function index()
    {
        $categoryModel = new CategoryModel();
        $categoriesDishes = $categoryModel->getAllCategoriesOfDishes();
        $categoriesDrinks = $categoryModel->getAllCategoriesOfDrinks();


        $this->view('home', ['allCategoriesDishes' => $categoriesDishes, 'allCategoriesDrinks' => $categoriesDrinks]);
    }

    function dishes()
    {
        $categoryModel = new CategoryModel();
        $dishModel = new DishModel();
     

        if (isset($_GET) && count($_GET) > 1) {
            $dishes = $dishModel-> getDishesBySearch($_GET);
     
        } else {
            $dishes = $dishModel->getAllDishes();
        }
        $categories = $categoryModel->getAllCategoriesOfDishes();
        if (count($_POST) > 0) {
            $cart = new Cart();
            $dish = $dishModel->findDish($dishes, $_POST['id']);
            $quantity = 1;
            $cart->addProduct($dish->id, $dish->name, $dish->picture, $quantity, $dish->price);
            header("Location: " . $_SERVER['REQUEST_URI']);
        }

        $this->view('display_products', ['allCategories' => $categories, 'allProducts' => $dishes, 'type' => 'dishes', 'maxPriceForProduct' => getMaxPriceForProducts($dishes)]);
    }

    function drinks()
    {
        $categoryModel = new CategoryModel();
        $drinksModel = new DrinksModel();
        if (isset($_GET) && count($_GET) > 1) {
            $drinks = $drinksModel-> getDrinksBySearch($_GET);
     
        } else {
            $drinks = $drinksModel->getDrinks();
        }
        $categories = $categoryModel->getAllCategoriesOfDrinks();
        if (count($_POST) > 0) {
            $cart = new Cart();

            $drink = $drinksModel->getDrink($_POST['id']);
            $quantity = 1;

            $cart->addProduct($drink->id, $drink->name, $drink->picture, $quantity, $drink->price);
            header("Location: " . $_SERVER['REQUEST_URI']);
        }

        $this->view('display_products', ['allCategories' => $categories, 'allProducts' => $drinks, 'type' => 'drinks','maxPriceForProduct' => getMaxPriceForProducts($drinks)]);
    }
}
