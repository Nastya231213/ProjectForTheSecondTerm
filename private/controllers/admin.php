<?php

/**
 * @file Admin.php
 * @brief Контролер для адміністрування.
 */

/**
 * @class Admin
 * @brief Клас Admin виконує різні функції адміністрування.
 */
class Admin extends Controller
{
    /**
     * @brief Функція для головної сторінки адміністратора.
     * 
     * Перевіряє, чи є користувач адміністратором. Якщо ні, перенаправляє на головну сторінку.
     * Якщо так, завантажує головну сторінку адміністратора.
     */
    function index()
    {
        if (!isAdmin()) {
            $this->redirect('home');
        } else {
            $adminName = $_SESSION['user']->name;
            $this->view('admin/dashboard', ['adminName' => $adminName]);
        }
    }

    /**
     * @brief Функція для сторінки управління категоріями.
     * 
     * Перевіряє, чи є користувач адміністратором. Якщо ні, перенаправляє на головну сторінку.
     * Якщо так, завантажує сторінку управління категоріями.
     */
    function category()
    {
        if (!isAdmin()) {
            $this->redirect('home');
        } else {
            $this->view('admin/categories');
        }
    }

    /**
     * @brief Функція для відображення сторінки додавання категорії.
     * 
     * Завантажує вид для додавання нової категорії.
     */
    function add_category()
    {
        $this->view('admin/add-category');
    }

    /**
     * @brief Функція для додавання нової страви.
     * 
     * Якщо POST-дані присутні, обробляє форму додавання нової страви.
     * В іншому випадку, завантажує сторінку додавання страви з переліком всіх категорій.
     */
    function add_dish()
    {
        if (count($_POST) > 0) {
            $dishModel = new DishModel();
            $name = $_POST['name'];
            $description = $_POST['description'];
            $ingredients = $_POST['ingredients'];
            $category_id = $_POST['category'];
            $price = $_POST['price'];
            
            if ($dishModel->addDish($name, $description, $ingredients, $category_id, $price)) {
                $_SESSION['successMessage'] = 'Страву додано';
            } else {
                $_SESSION['errorMessage'] = 'Щось пішло не так... Страву не додано';
            }
            
            $this->redirect('dish');
        }

        $categoryModel = new CategoryModel();
        $data['allCategories'] = $categoryModel->getAllCategories();
        $this->view('admin/add-dish', $data);
    }
}
