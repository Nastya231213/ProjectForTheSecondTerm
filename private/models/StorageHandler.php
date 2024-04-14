<?php

class StorageHandler extends AbstractReviewHandler {
    public function handle($reviewData) {
        $this->save($reviewData);
    }

    private function save($reviewData) {
        $model=new Model();
        $table='review';
        $model->insert($table,['product_id'=>$reviewData['product_id'],
        'user_id'=>$reviewData['user_id'],'rating'=>$reviewData['rating'],'comment'=>$reviewData['comment']]);
    }
}