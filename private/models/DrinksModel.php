<?php

class DrinksModel extends Model
{
    private $tableName = "drink";
    function addDrink($name, $description, $composition, $cat_id, $price, $volume)
    {
        $imageName = $this->addImage();
        return $this->insert(
            $this->tableName,
            ['name' => $name, 'description' => $description, 'volume' => $volume, 'picture' => $imageName, 'composition' => $composition, 'category_id' => $cat_id, 'price' => $price]
        );
    }

    function getDrink($id)
    {

        return $this->selectOne($this->tableName, ['id' => $id]);
    }
    function addImage()
    {
        if (count($_FILES) > 0) {

            $allowed[] = "image/jpeg";
            $allowed[] = "image/png";
            $allowed[] = "image/jpg";

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

    function getDrinks()
    {
        $this->query("   SELECT drink.*, category.name AS category_name, AVG(review.rating) AS average_rating
        FROM drink
        JOIN category ON drink.category_id = category.id
        LEFT JOIN review ON drink.id = review.product_id
        GROUP BY drink.id;");
        return $this->resultset();
    }
    function deleteDrink($id)
    {
        return $this->delete($this->tableName, ['id' => $id]);
    }
    function editDrink($id, $name, $description, $category_id, $composition, $volume, $price)
    {
        $updatedImage = $this->addImage();
        $data['name'] = $name;
        $data['description'] = $description;
        $data['category_id'] = $category_id;
        $data['composition'] = $composition;
        $data['price'] = $price;
        $data['volume'] = $volume;
        if ($updatedImage != null) {
            $data['picture'] = $updatedImage;
        }

        return $this->update(
            $this->tableName,
            $data,
            ['id' => $id]
        );
    }
}
