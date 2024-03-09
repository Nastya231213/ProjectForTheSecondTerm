
<?php

class Registration extends Controller
{

    function index()
    {


        $data = array();

        if (count($_POST)>0) {
            $userModel = new UserModel();
            $email = trim($_POST['email']);

            if ($userModel->checkUserEmail($email)==false) {
                $name = trim($_POST['name']);
                $surname = trim($_POST['surname']);
                $address = trim($_POST['address']);
                $password = trim($_POST['password']);
                $userModel->registerUser($name,$surname,$address,$password,$email);
                $this->redirect('login');
            }
        }

        $this->view('sign-up-form',);
    }
}
