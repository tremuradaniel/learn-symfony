<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
     * @dataProvider provideUrls
     */
    public function testSomething($url)
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());

    }

    public function provideUrls()
    {
        return [
            ['/'],
            ['/login']
        ];
    }
}
