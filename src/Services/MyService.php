<?php

  namespace App\Services;

  class MyService {
    public function __construct()
    {
      // dump($second_service);
    }

    /**
     * @required
    */
    public function setSecondService(MySecondService $second_service)
    {
      dump($second_service);
    }
  }
