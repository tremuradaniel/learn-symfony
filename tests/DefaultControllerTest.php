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

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Hello")')->count()
        );
        // $this->assertGreaterThan(0, $crawler->filter('h1.class')->count());
        $this->assertCount(1, $crawler->filter('h2'));
//        $this->assertTrue(
//            $client->getResponse()->headers->contains(
//                'Content-Type',
//                'application/json'
//            ),
//            'the "Content-Type" header is "application/json"' // optional message shown on failure
//        );
//        $this->assertStringContainsString('foo', $client->getResponse()->getContent());
        $this->assertRegExp('/foo(bar)?/', $client->getResponse()->getContent());
        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');
        $this->assertTrue($client->getResponse()->isNotFound());
        $this->assertEquals(
            200, // or Symfony\Component\HttpFoundation\Response::HTTP_OK
            $client->getResponse()->getStatusCode()
        );
        $this->assertTrue(
            $client->getResponse()->isRedirect('/demo/contact')
        // if the redirection URL was generated as an absolute URL
        // $client->getResponse()->isRedirect('http://localhost/demo/contact')
        );
        $this->assertTrue($client->getResponse()->isRedirect());
    }
}
