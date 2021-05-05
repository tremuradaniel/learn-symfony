<?php
    namespace App\Services;

    use Psr\Log\LoggerInterface;


    class GiftsService {

        public $gifts = ['a', 'b', 'c'];

        public function __construct (LoggerInterface $logger) {
            $logger->info('gifts were randomized!');
            shuffle($this->gifts);
        }

    }
