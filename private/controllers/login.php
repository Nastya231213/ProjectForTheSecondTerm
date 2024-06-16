<?php
/**
 * @file
 * Login.php
 *
 * @class Login
 *
 * @brief Клас Login відповідає за авторизацію користувачів і перенаправлення на відповідні сторінки.
 * Наслідує від базового контролера Controller.
 */

/**
 * Клас Login відповідає за авторизацію користувачів і перенаправлення на відповідні сторінки.
 * Наслідує від базового контролера Controller.
 */
class Login extends Controller
{

   /**
    * Відображає форму входу.
    * Перевіряє, чи користувач вже авторизований. Якщо так, перенаправляє на сторінку адміністратора чи домашню сторінку.
    * При вході перевіряє введений email і пароль. Якщо авторизація успішна, перенаправляє на відповідну сторінку.
    * Якщо авторизація невдала, виводить повідомлення про помилку.
    */
   function index()
   {
      $data = array();

      if (count($_POST) > 0) {
         $userModel = new UserModel();
         $email = $_POST['email'];
         $password = $_POST['password'];

         if ($userModel->loginUser($email, $password)) {
            if (isAdmin()) {
               $this->redirect("admin");
            } else {
               $this->redirect("home");
            }
         } else {
            $data['errorMessage'] = "Email or password wrong";
         }
      }

      $this->view("login-form", $data);
   }
}
