<?php 


class ReviewModel extends Model{

    private $tableName='review';
    function getAllReviews()
    {
        $this->query("SELECT review.*, user.name AS user_name
        FROM review
        JOIN user ON review.user_id = user.id;");

        return $this->resultset();
    }
    function getReviewsOfProduct($id){
        $this->query("SELECT review.*, user.name AS user_name
        FROM review
        JOIN user ON review.user_id = user.id WHERE review.product_id='$id'");
        return $this->resultset();
    }
    function deleteReview($id){
         $this->delete($this->tableName,['id'=>$id]);
    }

}