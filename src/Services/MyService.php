<?php

  namespace App\Services;

  class MyService {

    use OptionalServiceTrait;

    public function __construct()
    {
      // dump($second_service);
    }

    public function someAction()
    {
      dump($this->service->doSomething2());
    }

  }
