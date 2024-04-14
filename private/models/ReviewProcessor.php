<?php

class ReviewProcessor
{
    private $handler;

    public function __construct()
    {
        $this->handler = new ValidationHandler();
        $filteringHandler = new FilteringHandler();
        $storageHandler = new StorageHandler();

        $this->handler->setNext($filteringHandler);
        $filteringHandler->setNext($storageHandler);
    }


    public function processReview($reviewData)
    {
        $this->handler->handle($reviewData);
    }
}
