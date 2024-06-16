<?php
/**
 * @class DrinksModel
 * @brief Клас для роботи з таблицею "drink" у базі даних.
 * 
 * Цей клас надає методи для додавання, отримання, редагування та видалення напоїв, а також для пошуку напоїв за різними критеріями.
 */
class DrinksModel extends Model
{
    /** @var string $tableName Назва таблиці у базі даних */
    private $tableName = "drink";
    
    /**
     * @brief Додає новий напій до бази даних.
     * 
     * @param string $name Назва напою.
     * @param string $description Опис напою.
     * @param string $composition Склад напою.
     * @param int $cat_id Ідентифікатор категорії напою.
     * @param float $price Ціна напою.
     * @param float $volume Об'єм напою.
     * @return bool Повертає true у випадку успішного додавання, інакше false.
     */
    function addDrink($name, $description, $composition, $cat_id, $price, $volume)
    {
        $imageName = $this->addImage();
        return $this->insert(
            $this->tableName,
            ['name' => $name, 'description' => $description, 'volume' => $volume, 'picture' => $imageName, 'composition' => $composition, 'category_id' => $cat_id, 'price' => $price]
        );
    }

    /**
     * @brief Отримує інформацію про напій за його ідентифікатором.
     * 
     * @param int $id Ідентифікатор напою.
     * @return array Ассоціативний масив з інформацією про напій.
     */
    function getDrink($id)
    {
        return $this->selectOne($this->tableName, ['id' => $id]);
    }

    /**
     * @brief Завантажує зображення для напою.
     * 
     * @return string|null Повертає ім'я завантаженого файлу або null, якщо файл не був завантажений.
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
     * @brief Отримує список напоїв з бази даних з урахуванням пагінації.
     * 
     * @param int $limit Максимальна кількість напоїв для отримання.
     * @param int $offset Зміщення для пагінації.
     * @return array Масив ассоціативних масивів з інформацією про напої.
     */
    function getDrinks($limit, $offset)
    {
        $query = "SELECT drink.*, category.name AS category_name, AVG(review.rating) AS average_rating
                  FROM drink
                  JOIN category ON drink.category_id = category.id
                  LEFT JOIN review ON drink.id = review.product_id
                  GROUP BY drink.id
                  LIMIT $limit OFFSET $offset";
    
        $this->query($query);
        return $this->resultset();
    }

    /**
     * @brief Видаляє напій з бази даних за його ідентифікатором.
     * 
     * @param int $id Ідентифікатор напою.
     * @return bool Повертає true у випадку успішного видалення, інакше false.
     */
    function deleteDrink($id)
    {
        return $this->delete($this->tableName, ['id' => $id]);
    }

    /**
     * @brief Оновлює інформацію про існуючий напій у базі даних.
     * 
     * @param int $id Ідентифікатор напою.
     * @param string $name Назва напою.
     * @param string $description Опис напою.
     * @param int $category_id Ідентифікатор категорії напою.
     * @param string $composition Склад напою.
     * @param float $volume Об'єм напою.
     * @param float $price Ціна напою.
     * @return bool Повертає true у випадку успішного оновлення, інакше false.
     */
    function editDrink($id, $name, $description, $category_id, $composition, $volume, $price)
    {
        $updatedImage = $this->addImage();
        $data = [
            'name' => $name,
            'description' => $description,
            'category_id' => $category_id,
            'composition' => $composition,
            'price' => $price,
            'volume' => $volume
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
     * @brief Пошук напоїв за вказаними критеріями.
     * 
     * @param array $dataAboutSearch Ассоціативний масив з критеріями пошуку.
     * - 'find' (string): Ключове слово для пошуку в назвах напоїв або категоріях.
     * - 'categories' (array): Масив ідентифікаторів категорій для фільтрації.
     * - 'minValue' (float): Мінімальна ціна для фільтрації.
     * - 'maxValue' (float): Максимальна ціна для фільтрації.
     * @param int $limit Максимальна кількість напоїв для отримання.
     * @param int $offset Зміщення для пагінації.
     * @return array Масив ассоціативних масивів з інформацією про напої.
     */
    function getDrinksBySearch($dataAboutSearch, $limit, $offset)
    {
        $keyWord = $dataAboutSearch['find'];
        $categories = isset($dataAboutSearch['categories']) ? $dataAboutSearch['categories'] : [];
        $query = "SELECT drink.*, category.name AS category_name, AVG(review.rating) AS average_rating
                  FROM drink
                  JOIN category ON drink.category_id = category.id
                  LEFT JOIN review ON drink.id = review.product_id
                  WHERE 1";
        if (!empty($keyWord)) {
            $query .= " AND (drink.name LIKE '%$keyWord%' OR category.name LIKE '%$keyWord%')";
        }
    
        if (!empty($categories)) {
            $categoriesString = implode(',', $categories);
            $query .= " AND drink.category_id IN ($categoriesString)";
        }
        if (isset($dataAboutSearch['maxValue']) && isset($dataAboutSearch['minValue'])) {
            $maxValue = $dataAboutSearch['maxValue'];
            $minValue = $dataAboutSearch['minValue'];
            $query .= " AND drink.price >= $minValue AND drink.price <= $maxValue";
        }
        $query .= " GROUP BY drink.id LIMIT $limit OFFSET $offset";
    
        $this->query($query);
        return $this->resultset();
    }
}
