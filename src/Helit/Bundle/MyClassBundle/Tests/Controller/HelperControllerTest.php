<?php

namespace Helit\Bundle\MyClassBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HelperControllerTest extends WebTestCase
{
    public function testNavbar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/navbar');
    }

}
