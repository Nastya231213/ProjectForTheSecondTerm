<?php
/**
 * @file
 * Category.php
 * 
 * @class Category
 * 
 * @brief Клас Category відповідає за управління категоріями товарів в адміністративній частині.
 * Наслідує від базового контролера Controller.
 */

/**
 * Клас Category відповідає за управління категоріями товарів в адміністративній частині.
 * Наслідує від базового контролера Controller.
 */
class Category extends Controller
{

    /**
     * Відображає всі категорії. Доступно тільки адміністраторам.
     * Якщо користувач не є адміністратором, перенаправляє на головну сторінку.
     */
    function index()
    {
        if (!isAdmin()) {
            $this->redirect('home');
        } else {
            $data = array();
            $data = addMessage($data);
            $categoryModel = new CategoryModel();
            $data['allCategories'] = $categoryModel->getAllCategories();

            $this->view('admin/categories', $data);
        }
    }

    /**
     * Додає нову категорію.
     * Після успішного додавання виводить повідомлення про успішність операції.
     * У випадку невдалого додавання виводить повідомлення про помилку.
     */
    function add()
    {
        if (count($_POST) > 0) {
            $categoryModel = new CategoryModel();
            $name = $_POST['name'];
            $description = $_POST['description'];
            $type = $_POST['type'];

            if ($categoryModel->addCategory($name, $description, $type)) {
                $_SESSION['successMessage'] = 'The category has been added';
            } else {
                $_SESSION['errorMessage'] = 'Something goes wrong..The category has not been added';
            }
            $this->redirect('category');
        }
        $this->view('admin/add-category');
    }

    /**
     * Відображає форму для редагування існуючої категорії за її ідентифікатором.
     * При відправці форми зберігає змінені дані.
     * Після успішного редагування виводить повідомлення про успішність операції.
     * У випадку невдалого редагування виводить повідомлення про помилку.
     *
     * @param int $id Ідентифікатор категорії, яку потрібно редагувати.
     */
    function edit($id)
    {
        $categoryModel = new CategoryModel();

        if (count($_POST) > 0) {
            $name = $_POST['name'];
            $description = $_POST['description'];

            if ($categoryModel->editCategory($id, $name, $description)) {
                $_SESSION['successMessage'] = 'The category has been updated';
            } else {
                $_SESSION['errorMessage'] = 'Something goes wrong..The category has not been updated';
            }
            $this->redirect('category');
        } else {
            $category = $categoryModel->getCategory($id);
            $this->view('admin/edit-category', ['category' => $category]);
        }
    }

    /**
     * Видаляє категорію за її ідентифікатором.
     * Після успішного видалення виводить повідомлення про успішність операції.
     * У випадку невдалого видалення виводить повідомлення про помилку.
     *
     * @param int $id Ідентифікатор категорії, яку потрібно видалити.
     */
    function delete($id)
    {
        $categoryModel = new CategoryModel();
        if ($categoryModel->deleteCategory($id)) {
            $_SESSION['successMessage'] = 'The category has been deleted';
        } else {
            $_SESSION['errorMessage'] = 'Something goes wrong..';
        }

        $this->redirect('category');
    }
}
