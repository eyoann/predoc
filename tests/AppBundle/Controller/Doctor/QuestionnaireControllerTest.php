<?php

//src/AppBundle/Controller/Doctor/QuestionnaireController.php

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\Doctor\QuestionnaireController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
//use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Question;
use AppBundle\Entity\Response;
//use AppBundle\Entity\Questionnaire;

class QuestionnaireControllerTest extends WebTestCase
{
	/**
	* @var \AppBundle\Entity\Questionnaire
	*/
	protected $questionnaire;


	public function setUp()
	{
		//$this->questionnaires=[];
	}



    public function testIndex()
    {
    	$stub = 
        $client = static::createClient(
        	array(),
        	array(
        		'HTTP_HOST' => 'predoc-doctor.localhost',)
        	);
       $client->followRedirects(true);

        $crawler = $client->request('GET', '/questionnaire/');

        $questionnaires = $crawler->extract('repository.questionnaire');

        //array_push($this->questionnaires,'foo');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //$this->assertEquals('foo', $this->stack[count($this->questionnaires)-1] );
        $this->assertInternalType('array', $questionnaires);
        //$this->assertInternalType('questionnaire', $questionnaires[count($questionnaires)-1]);
    }
	

    public function testNew()
	{
        $client = static::createClient(
        	array(),
        	array(
        		'HTTP_HOST' => 'predoc-doctor.localhost',)
        	);
       $client->followRedirects(true);

        $crawler = $client->request('GET', '/questionnaire/new');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
		
	}

	/**
	* @dataProider questionnaireProvider
	*/


	public function questionnaireProvider()
	{
		return new CsvFileIterator('table1.csv');
	}
	



























}