<?php
/**
 * @file
 * AbstractReviewHandler.php
 *
 * @brief
 * Цей файл містить визначення класу AbstractReviewHandler.
 */

/**
 * @class AbstractReviewHandler
 *
 * @brief
 * Абстрактний клас, який реалізує інтерфейс ReviewHandler та забезпечує механізм обробки відгуків у ланцюжку відповідальності.
 *
 * @implements ReviewHandler
 */
abstract class AbstractReviewHandler implements ReviewHandler {
    /**
     * @var ReviewHandler|null $nextHandler
     * Наступний обробник у ланцюжку відповідальності.
     */
    private $nextHandler;

    /**
     * Встановлює наступного обробника у ланцюжку.
     *
     * @param ReviewHandler $handler Наступний обробник, який потрібно встановити.
     */
    public function setNext(ReviewHandler $handler) {
        $this->nextHandler = $handler;
    }

    /**
     * Обробляє дані відгуку. Якщо цей обробник не може обробити дані, він передає їх наступному обробнику у ланцюжку.
     *
     * @param mixed $reviewData Дані, пов'язані з відгуком, які потрібно обробити.
     */
    public function handle($reviewData) {
        if ($this->nextHandler !== null) {
            $this->nextHandler->handle($reviewData);
        }
    }
}
