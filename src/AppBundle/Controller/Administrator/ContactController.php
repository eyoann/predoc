<?php

namespace AppBundle\Controller\Administrator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use AppBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/affichermsg")
 
 */

class ContactController extends Controller
{		



        /**
        * @Route("/", name="affichermsg")
        */
		public function AfficherMsgAction($id){
		//$id=false;
		if($id){
			$em = $this->getDoctrine()->getManager();
			$qb = $this->getDoctrine()->getManager()->createQueryBuilder();
			$qb->add('select', 'c')
			->add('from', 'AppBundle:Contact c')
			;
			
			$qb->add('where', 'c.etat=1');
			$query = $qb->getQuery();
			$listmsg = $query->getResult();
			$type = 'Messages lus';
			$traiter = null;
		}else{
			
			$em = $this->getDoctrine()->getManager();
			$qb = $this->getDoctrine()->getManager()->createQueryBuilder();
			$qb->add('select', 'c')
			->add('from', 'AppBundle:Contact c')
			;
			
			$qb->add('where', 'c.etat=0');
			$query = $qb->getQuery();
			$listmsg = $query->getResult();
			$type = 'Messages Non Lus';
			$traiter = true;			
		}
		
		
		return $this->render('AppBundle:Contact:messages.html.twig', array( 'listmsg' => $listmsg , 'type' => $type , 'traiter' => $traiter ) );

		
	}
	
	public function MsgDetailsAction($id){
		
		$em = $this->getDoctrine()->getManager();
	
		$contact = $em
		->getRepository('AppBundle:Contact')
		->find($id)
		;
		
		$contact->setEtat(true); 
		$em->persist($contact);

		$em->flush();

		return $this->render('AppBundle:Contact:dtsmessages.html.twig', array( 'contact' => $contact  ) );
	}
	

}