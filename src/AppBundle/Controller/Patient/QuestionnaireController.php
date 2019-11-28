<?php

namespace AppBundle\Controller\Patient;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Question;


/**
 * @Route("/questionnaire")
 */
class QuestionnaireController extends Controller
{
    /**
     * @Route("/", name="questionnaire")
     */
    public function questionnaireAction(Request $request)
    {
        $user = $this->get("session")->get('user');
        if (!empty($user)&&!empty($user->get('id'))) {
            $questionnaireRoot = $this->get('repository.questionnaire')->find(1);

            $question = $questionnaireRoot->getQuestion();
            $session = $request->getSession();
            $session->remove('responses');
            return $this->redirectToRoute('question', ['id' => $question->getId()]);
        }
        $this->get('session')->getFlashBag()->set('error', true);
        return $this->redirectToRoute('patient_connectpage');
    }

    /**
     * @Route("/question/{id}", name="question", requirements={"id": "\d+"})
     */
    public function nextQuestionAction(Request $request, Question $question)
    {
        $response = $request->query->get('response');

        //SESSION
        $session = $request->getSession();
        $responses = $session->get('responses', array());
        if ($response) {
            $responses[] = $response;
        }
        $session->set('responses', $responses);

        return $this->render('patient/questionnaire.html.twig', ['question' => $question, 'user' => $session->get('user')]);
    }
}
