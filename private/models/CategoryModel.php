<?php
class CategoryModel extends Model
{
    private $tableName="category";
    function addCategory($name, $description)
    {
       $imageName=$this->addImage();
       return $this->insert($this->tableName,
       ['name'=>$name,'description'=>$description,'picture'=>$imageName]);

    }

    function getCategory($id){

        return $this->selectOne($this->tableName,['id'=>$id]);
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


    function getAllCategories(){
        return $this->select($this->tableName);
    }
    function deleteCategory($id){
        return $this->delete($this->tableName,['id'=>$id]);
    }
    function editCategory($id,$name,$description){
        $updatedImage=$this->addImage();
      return $this->update($this->tableName,['name'=>$name,'description'=>$description,'picture'=>$updatedImage],['id'=>$id]);
    }
}
