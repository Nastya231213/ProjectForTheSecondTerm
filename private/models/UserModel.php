




<?php
/**
 * @file UserModel.php
 * 
 * @brief Клас UserModel для роботи з користувачами в базі даних.
 */

/**
 * @class UserModel
 * 
 * @brief Клас для роботи з користувачами в базі даних.
 */
class UserModel extends Model
{
    /** @var string $tableName Назва таблиці користувачів в базі даних. */
    private $tableName = "user";

    /**
     * Перевіряє наявність користувача з вказаною електронною поштою.
     *
     * @param string $email Електронна пошта користувача для перевірки.
     * @return object|null Об'єкт користувача з бази даних або null, якщо користувач не знайдений.
     */
    function checkUserEmail($email)
    {
        return $this->selectOne($this->tableName, ['email' => $email]);
    }

    /**
     * Реєструє нового користувача в системі.
     *
     * @param string $name Ім'я користувача.
     * @param string $surname Прізвище користувача.
     * @param string $address Адреса користувача.
     * @param string $password Пароль користувача (не хешований).
     * @param string $email Електронна пошта користувача.
     * @return int|bool Ідентифікатор новоствореного запису користувача або false, якщо сталася помилка.
     */
    function registerUser($name, $surname, $address, $password, $email)
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        return $this->insert($this->tableName, [
            'name' => $name,
            'surname' => $surname,
            'address' => $address,
            'email' => $email,
            'password' => $passwordHash
        ]);
    }

    /**
     * Аутентифікує користувача з вказаною електронною поштою та паролем.
     *
     * @param string $email Електронна пошта користувача.
     * @param string $password Пароль користувача (не хешований).
     * @return bool Результат аутентифікації: true, якщо користувач успішно аутентифікований, інакше false.
     */
    function loginUser($email, $password)
    {
        $user = $this->selectOne($this->tableName, ['email' => $email]);
        if ($user && password_verify($password, $user->password)) {
            $_SESSION['user'] = $user;
            return true;
        }

        return false;
    }
}
