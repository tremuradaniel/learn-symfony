<?php
    namespace App\Services;

    class GiftsService {

        public $gifts = ['a', 'b', 'c'];

        public function __construct () {
            return shuffle($this->gifts);
        }

    }