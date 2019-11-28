<?php

//src/AppBundle/Controller/Patient/QuestionnaireController.php

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\Patien\SummaryController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Question;
use AppBundle\Entity\Response;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class SummaryTest extends WebTestCase
{

    public function setUp()
    {
    $this->client = static::createClient(array(
            'environment' => 'test',
    ),
        array(
            'HTTP_HOST' => 'patient/index.html.twig',
            //'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:20.0) Gecko/20100101 Firefox/20.0',
    ));

    static::$kernel = static::createKernel();
    static::$kernel->boot();
    $this->em = static::$kernel->getContainer()
                               ->get('doctrine')
                               ->getManager();
    $crawler = $this->client->followRedirects();
    }


    public function testGeneratePDF()
    {

        $this->client->enableProfiler();

        $crawler = $this->client->request('POST', 'AppBundle/Controller/Patient/SummaryController/generatePDFAction');
        $pageContent = ['Hello', 'PHP'];
        $assertedPdfGenerator = new PdfGenerator($pageContent);
        $assertedPdfContent = $assertedPdfGenerator->render();
        sleep(2);
        $testPdfContent = $crawler->render();

        // the content is different because of the /CreationDate
        $this->assertNotSame($assertedPdfContent, $crawler);

        $assertedImagick = new \Imagick();
        $assertedImagick->readImageBlob($assertedPdfContent);
        $assertedImagick->resetIterator();
        $assertedImagick = $assertedImagick->appendImages(true);
        $testImagick = new \Imagick();
        $testImagick->readImageBlob($crawler);
        $testImagick->resetIterator();
        $testImagick = $testImagick->appendImages(true);

        $diff = $assertedImagick->compareImages($testImagick, 1);
        $this->assertSame(0.0, $diff[1]);
    
    }




    public function testMail()
    {

        $this->client->enableProfiler();

        $crawler = $this->client->request('POST', 'AppBundle/Controller/Patient/SummaryController/mailAction');

        $mailCollector = $this->client->getProfile()->getCollector('swiftmailer');

        // Check that an email was sent
        $this->assertEquals(1, $mailCollector->getMessageCount());

        $collectedMessages = $mailCollector->getMessages();
        $message = $collectedMessages[0];

        // Asserting email data
        $this->assertInstanceOf('Swift_Message', $message);
        $this->assertEquals('Recapitulatif', $message->getSubject());
        $this->assertEquals('predoc.contact@gmail.fr', key($message->getFrom()));
        $this->assertEquals(
            $this->renderView(
                'patient/mail.html.twig',
                array('responses' => $responses)
            ),
            'text/html'
        ,
            $message->getBody()
        );
    }

    
    
    

    protected function tearDown()
    {
        parent::tearDown();

        $this->client->close();
        $this->client = null; // avoid memory leaks
    }
    

}