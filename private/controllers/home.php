


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
        $limit = 6;
        $pagination = new Pagination($limit);
        $offset = $pagination->offset;

        if (isset($_GET['minValue'])) {
            $dishes = $dishModel-> getDishesBySearch($_GET,$limit, $offset);     
        } else {
            $dishes = $dishModel->getAllDishes($limit,$offset);
        }
        $categories = $categoryModel->getAllCategoriesOfDishes();
        if (count($_POST) > 0) {
            $cart = new Cart();
            $dish = $dishModel->findDish($dishes, $_POST['id']);
            $quantity = 1;
            $cart->addProduct($dish->id, $dish->name, $dish->picture, $quantity, $dish->price,"dish");
            header("Location: " . $_SERVER['REQUEST_URI']);
        }

        $this->view('display_products', ['allCategories' => $categories, 'allProducts' => $dishes, 'pager'=>$pagination,
        'type' => 'dishes', 'maxPriceForProduct' => getMaxPriceForProducts($dishes)]);
    }

    function drinks()
    {
        $categoryModel = new CategoryModel();
        $drinksModel = new DrinksModel();
        $limit = 6;
        $pagination = new Pagination($limit);
        $offset = $pagination->offset;

        if (isset($_GET['minValue'])) {
            $drinks = $drinksModel-> getDrinksBySearch($_GET,$limit,$offset);
     
        } else {
            $drinks = $drinksModel->getDrinks($limit,$offset);
        }
        $categories = $categoryModel->getAllCategoriesOfDrinks();
        if (count($_POST) > 0) {
            $cart = new Cart();

            $drink = $drinksModel->getDrink($_POST['id']);
            $quantity = 1;

            $cart->addProduct($drink->id, $drink->name, $drink->picture, $quantity, $drink->price,"drinks");
            header("Location: " . $_SERVER['REQUEST_URI']);
        }

        $this->view('display_products', ['allCategories' => $categories, 
        'allProducts' => $drinks, 'type' => 'drinks',
        'maxPriceForProduct' => getMaxPriceForProducts($drinks),'pager'=>$pagination]);
    }
}
