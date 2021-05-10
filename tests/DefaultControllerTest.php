<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('Hello', $crawler->filter('h1')->text());

        $link = $crawler
            ->filter('a:contains("awesome link")')
            ->link();

        $crawler = $client->click($link);

        $this->assertStringContainsString('Remember me', $client->getResponse()->getContent());
    }
}
