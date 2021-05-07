<?php

namespace App\Services;

class ServiceTwo implements ServiceInterface {
    public function __construct()
    {
        dump('hello from ServiceTwo!');
    }
}
