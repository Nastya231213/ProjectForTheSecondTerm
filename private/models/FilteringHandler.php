<?php
class FilteringHandler extends AbstractReviewHandler
{
    public function handle($reviewData)
    {
        if (!$this->isSpam($reviewData)) {

            parent::handle($reviewData);
        }
    }
    private function isSpam($reviewData)
    {
        $spamWords = ['spam', 'ad', 'advertisement'];

        foreach ($spamWords as $spamWord) {
            if ( strpos($reviewData['comment'], $spamWord) !== false) {
                return true;
            }
        }
        return false;
    }
}
