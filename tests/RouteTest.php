<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class RouteTest extends WebTestCase
{
    /**
     * @dataProvider provideRoutes
     */
    public function testRoutes(string $route): void
    {
        $client = static::createClient();
        $client->request('GET', $route);

        $this->assertResponseIsSuccessful();
    }

    public function provideRoutes() {
        return [
            ['/'],
            ['/contactList'],
            ['/contact/new'],
            ['/contact/1'],
        ];
    }


    public function testHomepage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $imgCat = $crawler
            ->filter('img')
            ->reduce(function ($node, $i) {
                if ($node->attr('src') == '/build/images/cat.webp') {
                    return true;
                }
            })->count();
        

        $this->assertSame(1, $imgCat);
    }

}
