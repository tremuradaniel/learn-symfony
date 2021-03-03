<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/JSONReturn", name="JSONReturn")
     */

    public function JSONReturn(): Response {
        return $this->json(['name' => 'Test']);
    }

    /**
     * @Route("/ResponseReturn", name="ResponseReturn")
     */

    public function ResponseReturn(): Response {
        return new Response("<h1>I'm a Response");
    }
}
