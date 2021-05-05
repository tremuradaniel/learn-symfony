<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Pdf;
use App\Entity\File;
use App\Entity\User;
use App\Entity\Video;
use App\Entity\Address;
use App\Services\GiftsService;
use App\Services\MyService;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{

    public function home(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $author = $entityManager->getRepository(Author::class)->findByIdWithPdf(2);
        dump($author);
        foreach($author->getFiles() as $file) {
            dump($file);
        }
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }

    /**
     * @Route("/service_parameters")
    */
    public function serviceParameters(Request $request, MyService $service) // service will be automatically instantiated
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController'
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


    /**
     * @Route(
     *  "/blog/{page}", 
     *  name="blog_list",
     *  requirements={"page"="\d+"}
     * )
     */

    public function blogList ($page) {
        return new Response("<h1>I'm the wildcard: $page");
    }

    /**
     * @Route(
     *  "/optionalParam/{page?}", 
     *  name="blog_list",
     *  requirements={"page"="\d+"}
     * )
     */

    public function optionalParameters ($page) {
        return new Response("<h1>I'm the wildcard: $page");
    }

    /**
     * @Route(
     *  "/defaultParam/{page}/{test}", 
     *  name="defaultParam",
     *  requirements={"page"="\d+"},
     *  defaults={"test": "test0"}
     * )
     */

    public function defaultParam ($page, $test) {
        return new Response("<h1>I'm the wildcard: $page, test: $test");
    }

    /**
     * @Route({
     *  "route1",
     *  "route2"
     * })
     */

    public function multipleRoute () {
        return new Response("<h1>multipleRoute</h1>");
    }

    /**
     * @Route({
     *  "en": "route",
     *  "ro": "ruta"
     * })
     */

    public function multipleLanguagesRoute () {
        return new Response("<h1>multipleLanguagesRoute</h1>");
    }

    /**
     * @Route(
     *  "/flash_message"
     * )
     */

    public function flashMessage () {
        $this->addFlash(
            'notice',
            'This is a flash...'
        );
        $this->addFlash(
            'warning',
            'warning'
        );
        return $this->render('default/twigWithFlash.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

     /**
     * @Route(
     *  "/cookies"
     * )
     */

    public function cookies () {
        $cookie = new Cookie(
            'my_cookie', // Cookie name
            'cookie value',
            time() + (2 * 365 * 24 * 60 * 60) // Expires after 2 years
        );
        $res = new Response("<h1>cookies</h1>");
        $res->headers->setCookie($cookie);
        $res->send();
        return $res;
    }

    /**
     * @Route(
     *  "/download"
     * )
     */

    public function download () {
        $path = $this->getParameter('download_directory');
        return $this->file($path . 'test.pdf');
    }

    /**
     * @Route(
     *  "/escape"
     * )
     */

    public function escape () {
        return $this->render('default/generalUrlsAndEscapeStrings.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    public function mostPopularPosts($number = 3) {
        echo 'I\'m $number var from mostPopularPosts: ' . $number .'<br>';

        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();

        $user->setName('Robert');
        $entityManager->persist($user);
        $entityManager->flush();

        dump('A new user was saved with the id of ' . $user->getId());

        // db call mock
        $posts = ['p1', 'p2', 'p3'];
        return $this->render('default/most_popular_posts.html.twig', [
            'posts' => $posts
        ]);
    }

     /**
     * @Route("/paramConv/{id}", name="default", name="home")
     */
    public function paramConv(Request $request, User $user)
    {
        // $entityManager = $this->getDoctrine()->getManager();
        dump($user);
        
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }  

     /**
     * @Route("/lifecycle")
     */
    public function lifecycle()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();

        $user->setName('Robert');
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }  

        /**
     * @Route("/video")
     */
    public function video()
    {
        $entityManager = $this->getDoctrine()->getManager();
        // $user = new User();

        // $user->setName('Robert');
        // for ($i=0; $i < 4; $i++) { 
        //     $video = new Video();
        //     $video->setTitle('Video title - ' . $i);
        //     $user->addVideo($video);
        //     $entityManager->persist($video);
             
        // }
        // $entityManager->persist($user);
        // $entityManager->flush();

        // dump('Created a video with the id of ' . $video->getId());
        // dump('Created an user with the id of ' . $user->getId());


        $video = $this->getDoctrine()
            ->getRepository(Video::class)
            ->find(1);

        dump('Get user info of video ');

        // this return some fields as null because symfony save resource
        dump($video->getUser());

        dump($video->getUser()->getName());

        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find(1);

        foreach ($user->getVideos() as $video) {
            dump($video->getTitle());
        }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }  


    /**
     * @Route("/address")
    */
    public function address()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();

        $user->setName('Tom');

        $address = new Address();

        $address->setStreet('Ressu');
        $address->setNumber('1');
        $user->setAddress($address);

        $entityManager->persist($user);
        $entityManager->persist($user);
        $entityManager->flush();

        dump($user->getAddress()->getStreet());

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }  

     /**
     * @Route("/manyToMany")
    */
    public function manyToMany()
    {
        $entityManager = $this->getDoctrine()->getManager();
       
        $user1 = $entityManager->getRepository(User::class)->find(1);
        // $user2 = $entityManager->getRepository(User::class)->find(2);
        // $user3 = $entityManager->getRepository(User::class)->find(3);

        // $user1->addFollowed($user2);
        // $user1->addFollowed($user3);
        // $user2->addFollowed($user1);

        // $entityManager->flush();

        dump($user1->getFollowed()->count());

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }


    /**
     * @Route("/eagerLoging")
    */
    public function eagerLoging()
    {
    

        $entityManager = $this->getDoctrine()->getManager();
        // $user = new User();

        // $user->setName('Robert');

        // for ($i = 1; $i <=3; $i++) {
        //     $video = new Video();
        //     $video->setTitle('Video title - ' . $i);
        //     $user->addVideo($video);
        //     $entityManager->persist($video);
        // }

        // $entityManager->persist($user);
        // $entityManager->flush();
        $user = $entityManager->getRepository(User::class)->findWithVideos(1);
        dump($user);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController'
        ]);

    }


}
