<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Sign in')->form();
        $form['email'] = 'user@user.com';
        $form['password'] = 'passw';

        $crawler = $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertEquals(1, $crawler->filter('a:contains("logout")')->count());

        // $this->assertSame(200, $client->getResponse()->getStatusCode());
        // $this->assertContains('Hello', $crawler->filter('h1')->text());

        // $link = $crawler
        // ->filter('a:contains("awesome link")')
        // ->link();

        // $crawler = $client->click($link);
        // $this->assertContains('Remember me', $client->getResponse()->getContent());

    }
}
