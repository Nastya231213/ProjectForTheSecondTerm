<?php
/**
 * @file
 * CategoryModel.php
 *
 * @brief
 * Цей файл містить визначення класу CategoryModel.
 */

/**
 * @class CategoryModel
 *
 * @brief
 * Клас для управління категоріями у базі даних. Дозволяє додавати, отримувати, редагувати та видаляти категорії, а також завантажувати зображення.
 */
class CategoryModel extends Model
{
    /**
     * @var string $tableName
     * Ім'я таблиці у базі даних.
     */
    private $tableName = "category";

    /**
     * Додає нову категорію до бази даних.
     *
     * @param string $name Назва категорії.
     * @param string $description Опис категорії.
     * @param string $type Тип категорії (наприклад, 'dish' або 'drinks').
     * @return mixed Результат виконання запиту.
     */
    function addCategory($name, $description, $type)
    {
        $imageName = $this->addImage();
        return $this->insert(
            $this->tableName,
            ['name' => $name, 'description' => $description, 'picture' => $imageName, 'type' => $type]
        );
    }

    /**
     * Отримує категорію за її ідентифікатором.
     *
     * @param int $id Ідентифікатор категорії.
     * @return mixed Дані категорії.
     */
    function getCategory($id)
    {
        return $this->selectOne($this->tableName, ['id' => $id]);
    }

    /**
     * Завантажує зображення на сервер і повертає ім'я файлу зображення.
     *
     * @return string|null Ім'я файлу зображення або null, якщо зображення не було завантажено.
     */
    function addImage()
    {
        if (count($_FILES) > 0) {
            $allowed = ["image/jpeg", "image/png", "image/jpg"];

            if ($_FILES['image']['error'] == 0 && in_array($_FILES['image']['type'], $allowed)) {
                $folder = '../private/assets/uploads/';
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $destination = $folder . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            }
            return $_FILES['image']['name'];
        }
        return null;
    }

    /**
     * Отримує всі категорії типу 'dish'.
     *
     * @return mixed Дані категорій.
     */
    function getAllCategoriesOfDishes()
    {
        return $this->select($this->tableName, ['type' => 'dish']);
    }

    /**
     * Отримує всі категорії з бази даних.
     *
     * @return mixed Дані категорій.
     */
    function getAllCategories()
    {
        return $this->select($this->tableName);
    }

    /**
     * Отримує всі категорії типу 'drinks'.
     *
     * @return mixed Дані категорій.
     */
    function getAllCategoriesOfDrinks()
    {
        return $this->select($this->tableName, ['type' => 'drinks']);
    }

    /**
     * Видаляє категорію за її ідентифікатором.
     *
     * @param int $id Ідентифікатор категорії.
     * @return mixed Результат виконання запиту.
     */
    function deleteCategory($id)
    {
        return $this->delete($this->tableName, ['id' => $id]);
    }

    /**
     * Редагує дані категорії за її ідентифікатором.
     *
     * @param int $id Ідентифікатор категорії.
     * @param string $name Назва категорії.
     * @param string $description Опис категорії.
     * @return mixed Результат виконання запиту.
     */
    function editCategory($id, $name, $description)
    {
        $updatedImage = $this->addImage();
        return $this->update($this->tableName, ['name' => $name, 'description' => $description, 'picture' => $updatedImage], ['id' => $id]);
    }
}
