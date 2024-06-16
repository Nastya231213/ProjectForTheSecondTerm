<?php

/**
 * @file
 * @brief Клас ReviewProcessor для обробки відгуків.
 */

/**
 * @class ReviewProcessor
 * 
 * @brief Клас для обробки відгуків.
 */
class ReviewProcessor
{
    /** @var ValidationHandler $handler Обробник валідації для відгуків. */
    private $handler;

    /**
     * Конструктор класу ReviewProcessor.
     * Ініціалізує обробник валідації, фільтрації та зберігання.
     */
    public function __construct()
    {
        $this->handler = new ValidationHandler();
        $filteringHandler = new FilteringHandler();
        $storageHandler = new StorageHandler();

        $this->handler->setNext($filteringHandler);
        $filteringHandler->setNext($storageHandler);
    }

    /**
     * Метод для обробки відгуку.
     *
     * @param array $reviewData Дані відгуку для обробки.
     */
    public function processReview($reviewData)
    {
        $this->handler->handle($reviewData);
    }
}
