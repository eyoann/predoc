<?php

namespace AppBundle\Controller\Patient;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('patient/index.html.twig');
    }

    /**
     * @Route("/connecter", name="patient_connectpage")
     */
    public function connectAction(Request $req)
    {
          
        if ($req->isMethod('POST')) {
            $user = $req->request;
            if(!empty($user->get('nom'))&&!empty($user->get('prenom'))&&!empty($user->get('email'))&&!empty($user->get('birthday'))&&!empty($user->get('gender'))){
                $user->set('id',time());
                $session  = $this->get("session"); 
                $session->remove('responses'); 
                $session->set("user",$user);
                return $this->redirect('questionnaire');
            } 
            $this->get('session')->getFlashBag()->set('error', true);
            return $this->redirectToRoute('patient_connectpage');
            
        }
        return $this->render('patient/connection.html.twig');
    }

    /**
     * @Route("/about", name="aboutpage")
     */
    public function aboutAction(Request $request)
    {

        return $this->render('default/about.html.twig');
    }

    /**
     * @Route("/contact", name="contactpage")
     */
    public function contactAction(Request $request)
    {
        return $this->render('default/contact.html.twig');
    }
}
