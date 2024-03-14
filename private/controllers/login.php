<?php


class Login extends Controller
{

   function index()
   {
      $data=array();

      if (count($_POST) > 0) {

         $userModel=new UserModel();
         $email=$_POST['email'];
         $password=$_POST['password'];
         if($user= $userModel->loginUser($email,$password)){
            
            if($email==ADMIN_EMAIL && $password==ADMIN_PASSWORD){
               $this->redirect("admin/home");

            }else{
               $this->redirect("home");

            }

         }else{
            $data['errorMessage']="Email or password wrong";
         }
      }

      $this->view("login-form",$data);
   }
}
