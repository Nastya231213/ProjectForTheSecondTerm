<?php
/**
 * @file FilteringHandler.php
 * @brief Обробник фільтрації відгуків для перевірки спаму.
 */

/**
 * @class FilteringHandler
 * @brief Клас FilteringHandler виконує фільтрацію відгуків для перевірки на спам.
 * 
 * Наслідує від AbstractReviewHandler і додає перевірку на спам перед обробкою відгуку.
 */
class FilteringHandler extends AbstractReviewHandler
{
    /**
     * @brief Обробляє відгук, якщо він не є спамом.
     * 
     * @param array $reviewData Дані відгуку, що обробляються.
     */
    public function handle($reviewData)
    {
        if (!$this->isSpam($reviewData)) {
            parent::handle($reviewData);
        }
    }

    /**
     * @brief Перевіряє, чи є відгук спамом.
     * 
     * @param array $reviewData Дані відгуку, що перевіряються.
     * @return bool Повертає true, якщо відгук містить спам, інакше false.
     */
    private function isSpam($reviewData)
    {
        $spamWords = ['spam', 'ad', 'advertisement'];

        foreach ($spamWords as $spamWord) {
            if (strpos($reviewData['comment'], $spamWord) !== false) {
                return true;
            }
        }
        return false;
    }
}
