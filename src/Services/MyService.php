<?php
  namespace App\Services;

  class MyService {
    public function __construct($param, $adminEmail, $globalParam)
    {
      dump($param);
      dump($adminEmail);
      dump($globalParam);
    }
  }