<?php


namespace App\Services;
use Doctrine\ORM\Event\PostFlushEventArgs;

  class MyService {

    public function __construct() {
      dump('here!');
    }

    public function postFlush(PostFlushEventArgs $args)
    {
      dump('hello from postFlush');
    }

    public function clear()
    {
      dump('cleared...');
    }

  }
