<?php
/**
 * @file
 * DishModel.php
 *
 * @brief
 * Цей файл містить визначення класу DishModel.
 */

/**
 * @class DishModel
 *
 * @brief
 * Клас для управління стравами у базі даних. Дозволяє додавати, отримувати, редагувати та видаляти страви, а також здійснювати пошук та завантажувати зображення.
 */
class DishModel extends Model
{
    /**
     * @var string $tableName
     * Ім'я таблиці у базі даних.
     */
    private $tableName = "dish";

    /**
     * Додає нову страву до бази даних.
     *
     * @param string $name Назва страви.
     * @param string $description Опис страви.
     * @param string $ingredients Інгредієнти страви.
     * @param int $cat_id Ідентифікатор категорії страви.
     * @param float $price Ціна страви.
     * @return mixed Результат виконання запиту.
     */
    function addDish($name, $description, $ingredients, $cat_id, $price)
    {
        $imageName = $this->addImage();
        return $this->insert(
            $this->tableName,
            ['name' => $name, 'description' => $description, 'picture' => $imageName, 'ingredients' => $ingredients, 'category_id' => $cat_id, 'price' => $price]
        );
    }

    /**
     * Отримує страву за її ідентифікатором.
     *
     * @param int $id Ідентифікатор страви.
     * @return mixed Дані страви.
     */
    function getDish($id)
    {
        return $this->selectOne($this->tableName, ['id' => $id]);
    }

    /**
     * Виконує пошук страв за ключовим словом, категоріями, ціновим діапазоном, з обмеженням кількості результатів та відступом.
     *
     * @param array $dataAboutSearch Дані про пошук (ключове слово, категорії, мінімальна та максимальна ціна).
     * @param int $limit Максимальна кількість результатів.
     * @param int $offset Відступ для результатів.
     * @return mixed Результати пошуку.
     */
    function getDishesBySearch($dataAboutSearch, $limit, $offset)
    {
        $keyWord = $dataAboutSearch['find'];
        $categories = isset($dataAboutSearch['categories']) ? $dataAboutSearch['categories'] : array();
        $query = "SELECT dish.*, category.name AS category_name, AVG(review.rating) AS average_rating
                  FROM $this->tableName AS dish
                  JOIN category ON dish.category_id = category.id
                  LEFT JOIN review ON dish.id = review.product_id
                  WHERE 1";
        if (!empty($keyWord)) {
            $query .= " AND (dish.name LIKE '%$keyWord%' OR category.name LIKE '%$keyWord%')";
        }

        if (!empty($categories)) {
            $categoriesString = implode(',', $categories);
            $query .= " AND dish.category_id IN ($categoriesString)";
        }
        if (isset($dataAboutSearch['maxValue']) && isset($dataAboutSearch['minValue'])) {
            $maxValue = $dataAboutSearch['maxValue'];
            $minValue = $dataAboutSearch['minValue'];
            $query .= " AND dish.price >= $minValue AND dish.price <= $maxValue";
        }
        $query .= " GROUP BY dish.id";
        $query .= " LIMIT $limit OFFSET $offset";

        $this->query($query);
        return $this->resultset();
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
     * Отримує всі страви з бази даних з обмеженням кількості результатів та відступом.
     *
     * @param int $limit Максимальна кількість результатів.
     * @param int $offset Відступ для результатів.
     * @return mixed Дані страв.
     */
    function getAllDishes($limit, $offset)
    {
        $this->query("
            SELECT dish.*, category.name AS category_name, AVG(review.rating) AS average_rating
            FROM dish
            JOIN category ON dish.category_id = category.id
            LEFT JOIN review ON dish.id = review.product_id
            GROUP BY dish.id
            LIMIT $limit
            OFFSET $offset;
        ");
        return $this->resultset();
    }

    /**
     * Знаходить страву у списку страв за її ідентифікатором.
     *
     * @param array $dishes Масив об'єктів страв.
     * @param int $dishId Ідентифікатор страви.
     * @return mixed Об'єкт страви або null, якщо страву не знайдено.
     */
    function findDish($dishes, $dishId)
    {
        foreach ($dishes as $dish) {
            if ($dish->id == $dishId) {
                return $dish;
            }
        }
        return null;
    }

    /**
     * Видаляє страву за її ідентифікатором.
     *
     * @param int $id Ідентифікатор страви.
     * @return mixed Результат виконання запиту.
     */
    function deleteDish($id)
    {
        return $this->delete($this->tableName, ['id' => $id]);
    }

    /**
     * Редагує дані страви за її ідентифікатором.
     *
     * @param int $id Ідентифікатор страви.
     * @param string $name Назва страви.
     * @param string $description Опис страви.
     * @param int $category_id Ідентифікатор категорії страви.
     * @return mixed Результат виконання запиту.
     */
    function editDish($id, $name, $description, $category_id)
    {
        $updatedImage = $this->addImage();
        $data = [
            'name' => $name,
            'description' => $description,
            'category_id' => $category_id
        ];
        if ($updatedImage != null) {
            $data['picture'] = $updatedImage;
        }
        return $this->update(
            $this->tableName,
            $data,
            ['id' => $id]
        );
    }

    /**
     * Отримує інформацію про продукт за його ідентифікатором, включаючи категорію та середню оцінку.
     *
     * @param int $id Ідентифікатор продукту.
     * @return mixed Дані про продукт.
     */
    function getProduct($id)
    {
        $this->query("
        SELECT 
            dish.*, 
            category.name AS category_name, 
            AVG(review.rating) AS average_rating
        FROM 
            dish
        JOIN 
            category ON dish.category_id = category.id
        LEFT JOIN 
            review ON dish.id = review.product_id
        WHERE 
            dish.id = $id
        GROUP BY 
            dish.id ;
    ");
        return $this->single();
    }
}
