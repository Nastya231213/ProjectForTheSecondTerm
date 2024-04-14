<?php

abstract class AbstractReviewHandler implements ReviewHandler {
    private $nextHandler;

    public function setNext(ReviewHandler $handler) {
        $this->nextHandler = $handler;
    }

    public function handle($reviewData) {
        if ($this->nextHandler !== null) {
            $this->nextHandler->handle($reviewData);
        }
    }
}