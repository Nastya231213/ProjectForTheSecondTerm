<?php
/**
 * @file ReviewHandler.php
 * @brief Інтерфейс для обробки відгуків.
 */

/**
 * @interface ReviewHandler
 * @brief Інтерфейс ReviewHandler визначає методи для обробки відгуків.
 */
interface ReviewHandler {
    /**
     * @brief Встановлює наступний обробник в ланцюжку.
     *
     * @param ReviewHandler $handler Наступний обробник в ланцюжку.
     * @return void
     */
    public function setNext(ReviewHandler $handler);

    /**
     * @brief Обробляє відгук.
     *
     * @param mixed $review Відгук для обробки.
     * @return void
     */
    public function handle($review);
}
