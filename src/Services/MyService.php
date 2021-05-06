<?php

  namespace App\Services;

  class MyService {

    public function __construct($service) {
      dump($service);
      $this->secService = $service;
    }

  }
