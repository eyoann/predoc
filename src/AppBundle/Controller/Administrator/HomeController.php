<?php

namespace AppBundle\Controller\Administrator;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\FOSUserEvents;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Route("/")
 * @Security("has_role('ROLE_ADMIN')")
 */
class HomeController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('administrator/index.html.twig');
    }
    /**
  * @Route("/adduser", name="adduser")
 */
  public function AjouterAction(Request $request){
	  $user = new User();
	  
	  	//$form = $this->get('form.factory')->create(new UserType, $user);
	  $form = $this->createForm(UserType::class, $user);
	
	$form->handleRequest($request);
	if ($form->isValid()) {
		$em = $this->getDoctrine()->getManager();
		///$user->upload();
		$user->setSalt('');
		$user->setRoles(array('ROLE_ADMIN'));
		$em->persist($user);
		$em->flush();
	}
	
	
	return $this->render('administrator/adduser.html.twig');
		
  }

  
}


