

<?php
/**
 * @file Model.php
 * @brief Модель для роботи з базою даних.
 */

/**
 * @class Model
 * @brief Клас Model забезпечує основні операції з базою даних (CRUD).
 * 
 * Наслідує від класу Database і додає методи для вибірки, вставки, видалення та оновлення даних.
 */
class Model extends Database
{
    /**
     * @brief Конструктор класу Model.
     * 
     * Викликає конструктор батьківського класу Database.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @brief Вибирає дані з таблиці.
     * 
     * @param string $table Назва таблиці.
     * @param array $where Умови для вибірки (опціонально).
     * @return array Результат вибірки.
     */
    public function select($table, $where = [])
    {
        $sql = "SELECT * FROM $table";
        if (!empty($where)) {
            $sql .= " WHERE ";
            $iterator = 0;
            foreach ($where as $key => $value) {
                $sql .= $key . " = :" . $key;
                if ($iterator < (count($where) - 1)) {
                    $sql .= " AND ";
                }
                $iterator++;
            }
        }

        $this->query($sql);
        if (!empty($where)) {
            foreach ($where as $key => $value) {
                $this->bind(':' . $key, $value);
            }
        }
        return $this->resultset();
    }

    /**
     * @brief Вибирає один запис з таблиці.
     * 
     * @param string $table Назва таблиці.
     * @param array $where Умови для вибірки (опціонально).
     * @return mixed Один запис з таблиці.
     */
    public function selectOne($table, $where = [])
    {
        $sql = "SELECT * FROM $table";
        if (!empty($where)) {
            $sql .= " WHERE ";
            $iterator = 0;
            foreach ($where as $key => $value) {
                $sql .= $key . " = :" . $key;
                if ($iterator < (count($where) - 1)) {
                    $sql .= " AND ";
                }
                $iterator++;
            }
        }

        $this->query($sql);
        if (!empty($where)) {
            foreach ($where as $key => $value) {
                $this->bind(':' . $key, $value);
            }
        }
        return $this->single();
    }

    /**
     * @brief Вставляє новий запис у таблицю.
     * 
     * @param string $table Назва таблиці.
     * @param array $data Дані для вставки.
     * @return bool Результат виконання запиту.
     */
    public function insert($table, $data)
    {
        $keys = implode(',', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($keys) VALUES($values)";

        $this->query($sql);
        foreach ($data as $key => $value) {
            $this->bind(':' . $key, $value);
        }
        return $this->execute();
    }

    /**
     * @brief Видаляє запис з таблиці.
     * 
     * @param string $table Назва таблиці.
     * @param array $where Умови для видалення.
     * @return bool Результат виконання запиту.
     */
    public function delete($table, $where = [])
    {
        if (empty($where)) {
            return false;
        }
        $sql = "DELETE FROM $table WHERE ";
        $iterator = 0;
        foreach ($where as $key => $value) {
            $sql .= $key . "=:" . $key;
            if ($iterator < (count($where) - 1)) {
                $sql .= " AND ";
            }
            $iterator++;
        }
        $this->query($sql);

        foreach ($where as $key => $value) {
            $this->bind(':' . $key, $value);
        }
        return $this->execute();
    }

    /**
     * @brief Оновлює запис у таблиці.
     * 
     * @param string $table Назва таблиці.
     * @param array $data Дані для оновлення.
     * @param array $where Умови для оновлення.
     * @return bool Результат виконання запиту.
     */
    public function update($table, $data = [], $where = [])
    {
        if (empty($where) && empty($data)) {
            return false;
        }

        $sql = "UPDATE $table SET ";
        $iterator = 0;

        foreach ($data as $key => $value) {
            $sql .= $key . " = :" . $key;
            if ($iterator < (count($data) - 1)) {
                $sql .= ", ";
            }
            $iterator++;
        }

        $sql .= " WHERE ";
        $iterator = 0;

        foreach ($where as $key => $value) {
            $sql .= $key . " = :" . $key;
            if ($iterator < (count($where) - 1)) {
                $sql .= " AND ";
            }
            $iterator++;
        }

        $this->query($sql);

        foreach ($data as $key => $value) {
            $this->bind(':' . $key, $value);
        }

        foreach ($where as $key => $value) {
            $this->bind(':' . $key, $value);
        }
        return $this->execute();
    }
}
