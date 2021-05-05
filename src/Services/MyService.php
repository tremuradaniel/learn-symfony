<?php

  namespace App\Services;

  class MyService {
    public function __construct(MySecondService $second_service)
    {
      dump($second_service);
    }
  }
