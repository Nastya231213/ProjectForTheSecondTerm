<?php

/**
 * @class StorageHandler
 * 
 * @brief Клас, який зберігає відгуки про продукт в базі даних.
 */
class StorageHandler extends AbstractReviewHandler {

    /**
     * Зберігає відгук у базі даних.
     *
     * @param array $reviewData Дані відгуку, які включають product_id, user_id, rating та comment.
     */
    public function handle($reviewData) {
        $this->save($reviewData);
    }

    /**
     * Приватний метод для зберігання відгуку у базі даних.
     *
     * @param array $reviewData Дані відгуку, які включають product_id, user_id, rating та comment.
     */
    private function save($reviewData) {
        $model = new Model();
        $table = 'review';
        $model->insert($table, [
            'product_id' => $reviewData['product_id'],
            'user_id' => $reviewData['user_id'],
            'rating' => $reviewData['rating'],
            'comment' => $reviewData['comment']
        ]);
    }
}
