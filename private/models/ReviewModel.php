<?php 

/**
 * @class ReviewModel
 * 
 * @brief Модель для роботи з відгуками користувачів.
 */
class ReviewModel extends Model{

    /** @var string $tableName Назва таблиці в базі даних, де зберігаються відгуки. */
    private $tableName='review';

    /**
     * Отримати всі відгуки з іменами користувачів.
     *
     * @return array Результат запиту у вигляді масиву об'єктів.
     */
    function getAllReviews()
    {
        $this->query("SELECT review.*, user.name AS user_name
                      FROM review
                      JOIN user ON review.user_id = user.id;");

        return $this->resultset();
    }

    /**
     * Отримати відгуки про певний продукт з іменами користувачів.
     *
     * @param int $id ID продукту.
     * @return array Результат запиту у вигляді масиву об'єктів.
     */
    function getReviewsOfProduct($id){
        $this->query("SELECT review.*, user.name AS user_name
                      FROM review
                      JOIN user ON review.user_id = user.id 
                      WHERE review.product_id='$id'");
        return $this->resultset();
    }

    /**
     * Видалити відгук за його ID.
     *
     * @param int $id ID відгуку для видалення.
     */
    function deleteReview($id){
         $this->delete($this->tableName,['id'=>$id]);
    }

}
