<?php

namespace AppBundle\Controller\Administrator;
//use Symfony\Component\HttpFoundation\File\UploadedFile;

//use UserBundle\Entity\User;
use AppBundle\Entity\Questionnaire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\QuestionnaireType; 
use AppBundle\Entity\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
  
/**
 * @Route("/questionnaire")
 * @Security("has_role('ROLE_ADMIN')")
 */

class QuestionnaireController extends Controller
{
  /**
  * @Route("/", name="list_questionnaire")
  */
	
	public function listAction(Request $request)
  {
      $repository = $this->get('repository.questionnaire');
      $listQuest = $repository->findAll();

      return $this->render('administrator/listQuest.html.twig', ['questionnaires' => $listQuest]);

  }
  

  /**
  * @Route("/public/{id}", name="public", requirements={"id": "\d+"})
  */
  public function publicAction(Request $request ,Questionnaire $questionnaire)
  {
      
     $repository = $this->get('repository.questionnaire');
     $firstQuest = $repository->find(1);
     $response = new Response ();
     $response->setImage("");
     $response->setText($questionnaire->getTitle());
     $response->setNextQuestion($questionnaire->getQuestion());
     $question = $firstQuest->getQuestion();
     $question->addResponse($response);
     $response->setPreviousQuestion($question);
     $questionnaire->setPublic(true);

     $emQuestion = $this->get('manager.question');
     $emResponse = $this->get('manager.response');
     $emQuestionnaire = $this->get('manager.questionnaire');

     $emQuestion->persist($question);
     $emResponse->persist($response);
     $emQuestionnaire->persist($questionnaire);


     $emQuestionnaire->flush();
     $emQuestion->flush();
     $emResponse->flush();

     return $this->render('patient/index.html.twig');



  }



















    // deuxième méthode 

    /*$formBuilder = $this->get('form.factory')->createBuilder('form', $quest);

    // On ajoute les champs de l'entité que l'on veut à notre formulaire
    $formBuilder
      
      ->add('title',     'text')
      ->add('save',      'submit')
    ;
    // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

    // À partir du formBuilder, on génère le formulaire
    $form = $formBuilder->getForm();
    return $this->render('AppBundle:Questionnaire:addquestionnaire.html.twig', array(
      'form' => $form->createView(),
    ));
	}
}*/

    /**
     * @Route("/listeQuest", name="new_administrator_questionnaire")
     */

/*public function listeQuestAction(){
    
    $em = $this->getDoctrine()->getManager();
  
    $listequest = $em
    ->getRepository('AppBundle:Questionnaire')
    ->findAll()
    ;
  
    return $this->render('AppBundle:Questionnaire:listequest.html.twig', array( 'listequest' => $listequest ) );
  }
  */
}