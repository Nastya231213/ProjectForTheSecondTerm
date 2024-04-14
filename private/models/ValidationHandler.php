<?php


class ValidationHandler extends AbstractReviewHandler
{
    public function handle($reviewData)
    {
        if ($this->isValid($reviewData)) {
            parent::handle($reviewData);
        } else {
        }
    }

    private function isValid($reviewData)
    {
        return true;
    }
}
