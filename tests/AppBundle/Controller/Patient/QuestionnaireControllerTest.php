<?php

//src/AppBundle/Controller/Patient/QuestionnaireController.php

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\Patien\HomeController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Question;
use AppBundle\Entity\Response;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test;
use Symfony\Component\HttpKernel\EventListener;


class QuestionnaireControllerTest extends \PHPUnit\Framework\TestCase
{
	public function setUp()
	{
        $stub = $this->createMock(HttpFoundation\Request::class);

	}

    public function testControllerResponse()
    {
        $matcher = $this->createMock(Routing\Matcher\UrlMatcherInterface::class);
        $matcher
            ->expects($this->once())
            ->method('get')
            ->will($this->returnValue(array(
                //'_halt_compiler' => ,
                '_route' => 'foo',
                '_controller' => function ($request) {
                    return new Response('Hello'.$name);
                }
            )))
        ;
        $matcher
            ->expects($this->once())
            ->method('getContext')
            ->will($this->returnValue($this->createMock(Routing\RequestContext::class)))
        ;
        $controllerResolver = new ControllerResolver();
        $argumentResolver = new ArgumentResolver();

        $framework = new Framework($matcher, $controllerResolver, $argumentResolver);

        $response = $framework->handle(new Request());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Hello Fabien', $response->getContent());
    }
	

    public function testQuestionnaire()
	{
        $client = $stub;
        $this->client->enableProfiler();

        $crawler = $client->request('POST', 'AppBundle/Controller/Patient/QuestionnaireController/questionnaireAction');

        $stub = $this->getMockBuilder($request)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        $stub->method('questionnaireAction')
             ->willReturn('foo');
        
        $this->assertEquals('foo', $stub->questionnaireAction());




	}

	public function testNextQuestion()
	{
        $client = $stub;
        $this->client->enableProfiler();

        $crawler = $this->client->request('POST', 'AppBundle/Controller/Patient/QuestionnaireController/nextQuestionAction');


	}

	protected function tearDown()
    {
        parent::tearDown();

        $this->client->close();
        $this->client = null; // avoid memory leaks
    }
}