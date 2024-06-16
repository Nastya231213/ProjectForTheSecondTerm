<?php

/**
 * @file
 * Drinks.php
 */
 /**@class Drinks
 *
 * @brief Клас Drinks відповідає за управління напоями в адміністративній частині.
 * Наслідує від базового контролера Controller.
 */

class Drinks extends Controller
{

    /**
     * Відображає всі напої. Доступно тільки адміністраторам.
     * Якщо користувач не є адміністратором, перенаправляє на головну сторінку.
     */
    function index()
    {
        $limit = 6;
        $pagination = new Pagination($limit);
        $offset = $pagination->offset;

        if (!isAdmin()) {
            $this->redirect('home');
        } else {
            $data = array();
            $data = addMessage($data);
            $drinkModel = new DrinksModel();
            $data['allDrinks'] = $drinkModel->getDrinks($limit, $offset);
            $data['pager'] = $pagination;

            $this->view('admin/drinks', $data);
        }
    }

    /**
     * Додає новий напій.
     * Після успішного додавання виводить повідомлення про успішність операції.
     * У випадку невдалого додавання виводить повідомлення про помилку.
     */
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
            $this->redirect('drink');
        }
        $categoryModel = new CategoryModel();
        $data['allCategories'] = $categoryModel->getAllCategories();
        $this->view('admin/add-drink', $data);
    }

    /**
     * Відображає форму для редагування існуючого напою за його ідентифікатором.
     * При відправці форми зберігає змінені дані.
     * Після успішного редагування виводить повідомлення про успішність операції.
     * У випадку невдалого редагування виводить повідомлення про помилку.
     *
     * @param int $id Ідентифікатор напою, який потрібно редагувати.
     */
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
            $data['drink'] = $drinkModel->getDrink($id)[0];

            $this->view('admin/edit-drink', $data);
        }
    }

    /**
     * Відображає деталі напою за його ідентифікатором, включаючи відгуки користувачів.
     *
     * @param int $index Ідентифікатор напою, для якого відображаються деталі.
     */
    function details($index)
    {
        $productModel = new DrinksModel();
        $reviewModel = new ReviewModel();

        $reviews = $reviewModel->getReviewsOfProduct($index);
        $product = $productModel->getDrink($index);
        $this->view('product_information', ['product' => $product, 'reviews' => $reviews]);
    }

    /**
     * Видаляє напій за його ідентифікатором.
     *
     * @param int $index Ідентифікатор напою, який потрібно видалити.
     */
    function delete($index)
    {
        $drinkModel = new DrinksModel();
        $drinkModel->deleteDrink($index);
        $this->redirect('drinks');
    }
}
