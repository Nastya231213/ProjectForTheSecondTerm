
<?php
/**
 * @file
 * Registration.php
 *
 * @class Registration
 *
 * @brief Клас для обробки реєстрації користувачів.
 */


class Registration extends Controller
{
    /**
     * @brief Відображення сторінки реєстрації користувача.
     *
     * При відправці форми перевіряється унікальність електронної адреси.
     * Якщо користувач з такою адресою вже існує, відображається повідомлення про помилку.
     * Інакше відбувається реєстрація нового користувача з введеними даними.
     * Після успішної реєстрації відбувається перенаправлення на сторінку входу.
     */
    function index()
    {
        $data = array();

        if (count($_POST) > 0) {
            $userModel = new UserModel();
            $email = trim($_POST['email']);

            if ($userModel->checkUserEmail($email) == false) {
                $name = trim($_POST['name']);
                $surname = trim($_POST['surname']);
                $address = trim($_POST['address']);
                $password = trim($_POST['password']);
                $userModel->registerUser($name, $surname, $address, $password, $email);
                $this->redirect('login');
            } else {
                $data['errorMessage'] = "A user with such email exists";
            }
        }

        $this->view('sign-up-form', $data);
    }
}
