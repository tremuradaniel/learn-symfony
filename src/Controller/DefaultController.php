<?php

namespace App\Controller;

use App\Services\GiftsService;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{

    public function __construct (GiftsService $gifts) {
        $gifts->gifts = [1, 2, 3, 4];
    }


    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        $users = ['Tim', 'Steve', 'Paul'];
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users
        ]);
    }

     /**
     * @Route("/users", name="users")
     */
    public function users(GiftsService $gifts): Response
    {

        // responsible for saving to the DB
        $entityManager = $this->getDoctrine()->getManager();


        // add new user each time page is loaded

        // $user = new User;
        // $user->setName('Ilie');
        // $user2 = new User;
        // $user2->setName('Marcel');

        // // preparation for saving in the DB
        // $entityManager->persist($user);
        // $entityManager->persist($user2);
        // // actual saving of both users
        // $entityManager->flush();

        $usersDB = $this->getDoctrine()->getRepository(User::class)->findAll();
        $users = array_map(function ($user) { return $user->getName(); }, $usersDB );

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'random_gifts' => $gifts->gifts
        ]);
    }

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

     /**
     * @Route("/wildCard/{wildCardValue}", name="wildCard")
     */

    public function wildCard($wildCardValue): Response {
        return new Response("<h1>I'm the wildcard: $wildCardValue");
    }

      /**
     * @Route("/redirectHome", name="redirectHome")
     */

    public function redirectHome (): Response {
        return $this->redirect('/');
    }

     /**
     * @Route("/redirectToRouteName", name="redirectToRouteName")
     */

    public function redirectToRouteName (): Response {
        return $this->redirectToRoute('JSONReturn');
    }

}
