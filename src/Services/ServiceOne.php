<?php


namespace App\Services;
use Doctrine\ORM\Event\PostFlushEventArgs;

  class ServiceOne implements ServiceInterface {
    public function __construct()
    {
        dump('hello from ServiceOne!');
    }
  }
