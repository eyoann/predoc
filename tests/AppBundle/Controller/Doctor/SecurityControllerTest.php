<?php

//src/AppBundle/Controller/Doctor/SecurityController.php

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\Doctor\SecurityController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\BrowserKit\Cookie;

class SecurityControllerTest extends WebTestCase
{

    public function testRenderLogin()
    {

        $client = static::createClient(
            array(),
            array(
                'HTTP_HOST' => 'predoc-doctor.localhost',)
            );

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form();

        $form['_username'] = 'admin';
        $form['_password'] = 'adminpass';

        $client->submit($form);
        //$crawler = $client->followRedirect();

        $this->assertEquals('FOS\UserBundle\Controller\SecurityController::checkAction', $client->getRequest()->attributes->get('_controller'));
    }

}
