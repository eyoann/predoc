<?php

namespace AppBundle\Controller\Patient;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\Email as EmailConstraint;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Question;
use Symfony\Component\HttpFoundation\Response;
use Dompdf\Dompdf;

use AppBundle\Entity\Participation;

/**
 * @Route("/recapitulatif")
 */
class SummaryController extends Controller
{
    /**
     * @Route("/", name="recapitulatif")
     */
    public function indexAction(Request $request)
    {
        $responseRepository = $this->get('repository.response');
        $emParticipation = $this->get('manager.participation');
        $emResponse = $this->get('manager.response');
        $response = $request->query->get('response');

        //SESSION
        $session = $request->getSession();
        $responsesID = $session->get('responses');
        $responsesID[] = $response;
        $responsesID = array_unique($responsesID);
        $session->set('responses', $responsesID);
        $responses = array();
        $questionnaires = array();

        $participation = new Participation();
        $participation->setDate(new \DateTime());
        foreach ($responsesID as $id) {
            $response = $responseRepository->find($id);
            $participation->addResponse($response);
            $response->addParticipation($participation);
            $emResponse->persist($response);
            $questionnaire = $response->getPreviousQuestion()->getQuestionnaire();
            $responses [] = $response;
            if(!in_array($questionnaire, $questionnaires, true)){
                $questionnaires [] = $questionnaire;
            }
        }

        $emParticipation->persist($participation);

        $emParticipation->flush();
        $emResponse->flush();

        return $this->render('patient/end.html.twig', [
            'responses' => $responses,
            'questionnaires' => $questionnaires
            ]
        );
    }

    /**
     * @Route("/mail", name="recapitulatif_mail")
     */
    public function mailAction(Request $request)
    {
        //http://symfony.com/doc/current/email.html

        $responseRepository = $this->get('repository.response');
        $mail = @ (string) $request->query->get('q');

        //SESSION
        $session = $request->getSession();
        $responsesID = $session->get('responses');
        $responses = array();
        $questionnaires = array();
        foreach ($responsesID as $id) {
            $response = $responseRepository->find($id);
            $questionnaire = $response->getPreviousQuestion()->getQuestionnaire();
            $responses [] = $response;
            if(!in_array($questionnaire, $questionnaires, true)){
                $questionnaires [] = $questionnaire;
            }
        }
        /*
        $constraints = array(
            new \Symfony\Component\Validator\Constraints\Email(),
            new \Symfony\Component\Validator\Constraints\NotBlank()
        );

        $errors = $this->get('validator')->validate($mail, $constraints);

        if($errors) {
            return $this->render('patient/end.html.twig', ['responses' => $responses, 'questionnaires' => $questionnaires]);
        }
        */


        //Mail
        $message = \Swift_Message::newInstance()
        ->setSubject('Recapitulatif')
        ->setFrom('predoc.contact@gmail.fr')
        ->setTo($mail)
        ->setBody(
            $this->renderView(
                'patient/mail.html.twig',
                array('responses' => $responses, 'questionnaires' => $questionnaires)
            ),
            'text/html'
        )
    ;

    $this->get('mailer')->send($message);

    return $this->render('patient/index.html.twig');

    }

    /**
     * @Route("/pdf", name="recapitulatif_pdf")
     */
    public function generatePDFAction(Request $request)
    {
        //http://blog.michaelperrin.fr/2016/02/17/generating-pdf-files-with-symfony/

        $responseRepository = $this->get('repository.response');
        //SESSION
        $session = $request->getSession();
        $responsesID = $session->get('responses');
        $responses = array();
        $questionnaires = array();
        foreach ($responsesID as $id) {
            $response = $responseRepository->find($id);
            $questionnaire = $response->getPreviousQuestion()->getQuestionnaire();
            $responses [] = $response;
            if(!in_array($questionnaire, $questionnaires, true)){
                $questionnaires [] = $questionnaire;
            }
        }

        $html = $this->renderView(
            'patient/pdf.html.twig',
            array('responses' => $responses, 'questionnaires' => $questionnaires)
        );

        $filename = sprintf('recapitulatif-%s.pdf', date('Y-m-d'));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );
    }

    /**
     * @Route("/save/pdf", name="save_pdf")
     */
    public function savePDFAction(Request $request)
    {
        $user = $this->get("session")->get('user');
        if (!empty($user)&&!empty($user->get('id'))) {
            $responseRepository = $this->get('repository.response');
            $session = $request->getSession();
            $responsesID = $session->get('responses');
            $responses = array();
            $questionnaires = array();
            foreach ($responsesID as $id) {
                $response = $responseRepository->find($id);
                $questionnaire = $response->getPreviousQuestion()->getQuestionnaire();
                $responses [] = $response;
                if(!in_array($questionnaire, $questionnaires, true)){
                    $questionnaires [] = $questionnaire;
                }
            }

            //return $this->render('patient/pdf.html.twig',compact('responses','user','questionnaires'));

            $html = $this->renderView(
                'patient/pdf.html.twig',compact('responses','user','questionnaires') 
            );
            $dompdf = new Dompdf();
            $dompdf->load_html($html);
            $dompdf->setPaper('A4');
            $dompdf->render();
            $dompdf->stream(time().'.pdf');

        }
            $this->get('session')->getFlashBag()->set('error', true);
            return $this->redirectToRoute('patient_connectpage');
    }
}
