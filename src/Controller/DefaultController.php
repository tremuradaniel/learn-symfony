<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;


    class DefaultController {
        
        public function index () {
            return new Response ('<h1>Hello, Symfony!</h1>');
        }
        
        public function home () {
            return new Response ('<h1>Hello from home!</h1>');
        }

    }