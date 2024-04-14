<?php

interface ReviewHandler {
    public function setNext(ReviewHandler $handler);
    public function handle($review);
}
