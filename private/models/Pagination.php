<?php
/**
 * @file
 *@brief Файл, що містить клас Pagination.
 */
/**
 * @class Pagination
 * 
 * @brief Клас для створення і відображення посторінкової навігації.
 */
class Pagination
{

    /** @var array $links Масив посилань на сторінки. */
    public $links = array();
    
    /** @var int $offset Зсув для вибірки даних з бази даних. */
    public $offset = 0;
    
    /** @var int $page_number Номер поточної сторінки. */
    public $page_number = 1;
    
    /** @var int $start Початковий номер сторінки в діапазоні навігації. */
    public $start = 1;
    
    /** @var int $end Кінцевий номер сторінки в діапазоні навігації. */
    public $end = 1;

    /**
     * Конструктор класу.
     *
     * @param int $limit Ліміт записів на сторінці.
     * @param int $extras Додаткова кількість сторінок вліво і вправо від поточної сторінки.
     */
    public function __construct($limit = 5, $extras = 1)
    {
        $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page_number = $page_number < 1 ? 1 : $page_number;
        $this->offset = ($page_number - 1) * $limit;
        $this->page_number = $page_number;
        $this->end = $page_number + $extras;
        $this->start = $page_number - $extras;
        if ($this->start < 1) {
            $this->start = 1;
        }

        $current_link = ROOT . "/" . str_replace(["url=", "index.php&"], "", $_SERVER['QUERY_STRING']);
        $current_link = !strstr($current_link, "page=") ? $current_link . "&page=1" : $current_link;
        $next_link = preg_replace('/page=[0-9]+/', "page=" . ($page_number + 1 + $extras), $current_link);
        $first_link = preg_replace('/page=[0-9]+/', "page=1", $current_link);

        $this->links['first'] = $first_link;
        $this->links['current'] = $current_link;
        $this->links['next'] = $next_link;
    }

    /**
     * Відображення посторінкової навігації.
     */
    public function display()
    {
    ?>
    <br class="clearfix">
    <div id="pager">
        <ul class="pagination justify-content-center ">
            <li class="page-item"><a class="page-link" href="<?= $this->links['first']; ?>">Перша</a></li>
            <?php for ($i = $this->start; $i <= $this->end; $i++) : ?>
                <li class="page-item <?= ($i === $this->page_number) ? 'active' : ''; ?>"><a class="page-link" href="<?= preg_replace('/page=[0-9]+/', "page=" . $i, $this->links['current']); ?>"><?= $i ?></a></li>
            <?php endfor ?>
            <li class="page-item"><a class="page-link" href="<?= $this->links['next'] ?>">Наступна</a></li>
        </ul>
    </div>
    <br>
    <?php
    }
}
