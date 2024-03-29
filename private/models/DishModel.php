<?php

class DishModel extends Model
{
    private $tableName = "dish";
    function addDish($name, $description, $ingredients,$cat_id)
    {
        $imageName = $this->addImage();
        return $this->insert(
            $this->tableName,
            ['name' => $name, 'description' => $description, 'picture' => $imageName, 'ingredients' => $ingredients,'category_id' => $cat_id]
        );
    }

    function getDish($id)
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


    function getAllDishes()
    {
        $this->query("SELECT dish.*, category.name AS category_name
        FROM dish
        JOIN category ON dish.category_id = category.id;");
        
      return $this->resultset();
    }
    function deleteDish($id)
    {
        return $this->delete($this->tableName, ['id' => $id]);
    }
    function editDish($id, $name, $description,$category_id)
    {
        $updatedImage = $this->addImage();
        $data['name']=$name;
        $data['description']=$description;
        $data['category_id']=$category_id;
        if($updatedImage!=null){
            $data['picture']= $updatedImage;

        }
        
        return $this->update($this->tableName,$data,
        ['id' => $id]);
    }
}
