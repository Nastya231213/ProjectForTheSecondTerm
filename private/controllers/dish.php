<?php
/**
 * @file
 * Dish.php
 */

/** @class Dish
 * 
 * @brief Клас Dish відповідає за управління стравами в адміністративній частині.
 * Наслідує від базового контролера Controller.
 */

class Dish extends Controller
{

    /**
     * Відображає всі страви. Доступно тільки адміністраторам.
     * Якщо користувач не є адміністратором, перенаправляє на головну сторінку.
     */
    function index()
    {

        if (!isAdmin()) {
            $this->redirect('home');
        } else {
            $limit = 6;
            $pagination = new Pagination($limit);
            $offset = $pagination->offset;
            $data = array();
            $data = addMessage($data);
            $dishModel = new DishModel();
            $data['allDishes'] = $dishModel->getAllDishes($limit, $offset);
            $data['pager'] = $pagination;

            $this->view('admin/dishes', $data);
        }
    }

    /**
     * Додає нову страву.
     * Після успішного додавання виводить повідомлення про успішність операції.
     * У випадку невдалого додавання виводить повідомлення про помилку.
     */
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

    /**
     * Відображає форму для редагування існуючої страви за її ідентифікатором.
     * При відправці форми зберігає змінені дані.
     * Після успішного редагування виводить повідомлення про успішність операції.
     * У випадку невдалого редагування виводить повідомлення про помилку.
     *
     * @param int $id Ідентифікатор страви, яку потрібно редагувати.
     */
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

    /**
     * Відображає деталі страви за її ідентифікатором, включаючи відгуки користувачів.
     *
     * @param int $index Ідентифікатор страви, для якої відображаються деталі.
     */
    function details($index)
    {
        $productModel = new DishModel();
        $reviewModel = new ReviewModel();

        $reviews = $reviewModel->getReviewsOfProduct($index);

        $product = $productModel->getProduct($index);
        $this->view('product_information', ['product' => $product, 'reviews' => $reviews]);
    }

    /**
     * Видаляє страву за її ідентифікатором.
     *
     * @param int $index Ідентифікатор страви, яку потрібно видалити.
     */
    function delete($index)
    {
        $dishModel =  new DishModel();
        $dishModel->deleteDish($index);
        $this->redirect('dish');
    }
}
