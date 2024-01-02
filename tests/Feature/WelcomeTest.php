<?php

namespace App\Tests\Feature;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class WelcomeTest extends TestCase
{
    public function test_that_the_page_welcome_can_render()
    {
        $url = 'http://localhost:8080/';

        $client = new Client();
        $response = $client->get($url);

        $this->assertEquals(200, $response->getStatusCode());
    }
}