<?php
/**
 * @file
 * Review.php
 */

/**
 * @class Review
 * @brief Клас для обробки відгуків користувачів.
 *
 * Клас Review розширює базовий клас контролера Controller.
 */
class Review extends Controller
{
    /**
     * @brief Відображення всіх відгуків.
     *
     * Якщо користувач не є адміністратором, відбувається перенаправлення на головну сторінку.
     * В іншому випадку відображаються всі відгуки з можливістю їх редагування та видалення.
     */
    function index()
    {
        if (!isAdmin()) {
            $this->redirect('home');
        } else {
            $data = array();
            $data = addMessage($data);
            $reviewsModel = new ReviewModel();
            $data['allReviews'] = $reviewsModel->getAllReviews();
            $this->view('admin/reviews', $data);
        }
    }

    /**
     * @brief Додавання відгуку для напою.
     *
     * @param int $index Ідентифікатор напою, до якого додається відгук.
     *
     * Викликає метод add() для додавання відгуку до напою.
     */
    function add_for_drink($index)
    {
        $this->add($index, 'drinks');
    }

    /**
     * @brief Додавання відгуку для страви.
     *
     * @param int $index Ідентифікатор страви, до якої додається відгук.
     *
     * Викликає метод add() для додавання відгуку до страви.
     */
    function add_for_dishes($index)
    {
        $this->add($index, 'dish');
    }

    /**
     * @brief Приватний метод для додавання відгуку.
     *
     * @param int $index Ідентифікатор продукту (страви або напою), до якого додається відгук.
     * @param string $type Тип продукту ('drinks' або 'dish').
     *
     * Якщо користувач не увійшов в систему, відбувається перенаправлення на сторінку входу.
     * При відправці форми зберігаються дані відгуку до відповідного продукту.
     * Відбувається перенаправлення на сторінку деталей продукту після успішного додавання відгуку.
     */
    private function add($index, $type)
    {
        if (!isLoggedIn()) {
            $this->redirect('login');
        } else {
            if (count($_POST) > 0) {
                $data['rating'] = $_POST['rating'];
                $data['comment'] = $_POST['comment'];
                $data['user_id'] = $_SESSION['user']->id;
                $data['product_id'] = $index;
                $processor = new ReviewProcessor();
                $processor->processReview($data);
                $this->redirect($type . '/details/' . $index);
            }
            $this->view('add-review');
        }
    }

    /**
     * @brief Видалення відгуку.
     *
     * @param int $index Ідентифікатор відгуку, який потрібно видалити.
     *
     * Викликає метод deleteReview() моделі відгуків для видалення відгуку за його ідентифікатором.
     * Після видалення відбувається перенаправлення на сторінку адміністраторських відгуків.
     */
    function delete($index)
    {
        $reviewModel = new ReviewModel();
        $reviewModel->deleteReview($index);
        $this->view('admin/reviews');
    }
}
