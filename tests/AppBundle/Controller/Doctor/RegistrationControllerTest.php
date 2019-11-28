<?php

//src/AppBundle/Controller/Doctor/registrationController.php

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\Doctor\RegistrationController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Question;
use AppBundle\Entity\Response;
use Doctrine\Common\Collections\Expr\Comparison;

class RegistrationControllerTest extends WebTestCase
{
	public function setUp()
	{
        //$stub = $this->createMock(HttpFoundation\Request::class);
        $client = static::createClient();
	}


    public function testRegister()
    {
            $client = static::createClient(
            array(),
            array(
                'HTTP_HOST' => 'predoc-doctor.localhost',)
            );        
            $crawler = $client->request('GET', '/login');
            $crawler = $this->visit('register')
            ->type('tester', 'name')
            ->type('test@tester.com', 'email')
            ->type('testing', 'password')
            ->type('testing', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/doctor/index.html.twig')
            ->see('Dashboard');
                    // the firewall context defaults to the firewall name
        $firewallContext = 'secured_area';

        $token = new UsernamePasswordToken('doctor', null, $firewallContext, array());
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);

    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->client->close();
        $this->client = null; // avoid memory leaks
    }
}


	