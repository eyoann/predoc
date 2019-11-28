<?php

namespace AppBundle\Controller\Doctor;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Contact;

/**
 * @Route("/")
 * @Security("has_role('ROLE_DOCTOR')")
 */
class HomeController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('doctor/index.html.twig');
    }

    /**
     * @Route("/contact/{id}", name="help", requirements={"id": "\d+"})
     */
    public function helpAction(Request $request, Contact $contact)
    {
    	if ($request->isMethod('POST')) {
            //Mail
	        $message = \Swift_Message::newInstance()
	        	->setSubject($request->request->get('subject'))
	        	->setFrom($contact->getUser()->getEmail())
	        	->setTo('predoc.contact@gmail.com')
	        	->setBody($request->request->get('text')."<br>ContactMail :".$contact->getUser()->getEmail(),'text/html')
	        ;

	        $this->get('mailer')->send($message);
            return $this->render('doctor/index.html.twig');
        }
    	return $this->render('doctor/help.html.twig', array('contact' => $contact->getId()));
    }
}


