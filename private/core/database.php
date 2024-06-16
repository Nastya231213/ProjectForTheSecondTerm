<?php 

/**
 * @file
 * Код класу Database, який надає інтерфейс для взаємодії з базою даних MySQL через PDO.
 */
/**
 * @class Database
 * @brief Клас Database забезпечує з'єднання з базою даних та виконання запитів через PDO.
 */
class Database
{
    private $host = DB_HOST; 
    private $user = DB_USER; 
    private $pass = DB_PASS; 
    private $dbname = DB_NAME;

    private $dbh; 
    private $error; 
    private $stmt; 

    /**
     * Конструктор класу Database.
     * Ініціалізує з'єднання з базою даних за допомогою PDO.
     */
    public function __construct()
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        ];
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    /**
     * Підготувати SQL-запит для виконання.
     *
     * @param string $query SQL-запит для підготовки.
     */
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    /**
     * Прив'язати значення до параметру SQL-запиту.
     *
     * @param mixed $param Назва параметру в SQL-запиті.
     * @param mixed $value Значення для прив'язки.
     * @param int $type (optional) Тип даних параметру. По замовчуванню визначається автоматично.
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Виконати підготовлений SQL-запит.
     *
     * @return bool Логічне значення, що показує успішність виконання запиту.
     */
    public function execute()
    {
        return $this->stmt->execute();
    }

    /**
     * Отримати всі рядки результатів запиту як об'єкти.
     *
     * @return array Масив об'єктів, що представляють результати запиту.
     */
    public function resultset()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Отримати всі рядки результатів запиту як асоціативний масив.
     *
     * @return array Асоціативний масив, що представляє результати запиту.
     */
    public function resultSetArray()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Отримати перший рядок результату запиту як об'єкт.
     *
     * @return mixed Об'єкт, що представляє перший рядок результату запиту.
     */
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Отримати кількість рядків, що були змінені або вставлені або видалені в результаті попереднього SQL-запиту.
     *
     * @return int Кількість змінених рядків.
     */
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}


