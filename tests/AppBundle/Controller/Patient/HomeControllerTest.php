<?php

//src/AppBundle/Controller/Patient/HomeController.php

namespace tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use src\AppBundle\Controller\Patient;




class HomeControllerTest extends WebTestCase
{

	public function testIntex()
    {

        $client = static::createClient(
        	array(),
        	array(
        		'HTTP_HOST' => 'predoc.localhost',)
        	);
       $client->followRedirects(true);

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


}




