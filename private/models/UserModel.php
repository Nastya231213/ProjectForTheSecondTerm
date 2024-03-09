




<?php

class UserModel extends Model
{

    private $tableName = "user";

    function checkUserEmail($email)
    {
        return $this->selectOne($this->tableName, ['email' => $email]);
    }
    function registerUser($name, $surname, $address, $password, $email)
    {

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        return $this->insert($this->tableName,['name'=>$name,'surname'=>$surname,'address'=>$address,'email'=>$email,'password'=>$passwordHash]);
    }

}