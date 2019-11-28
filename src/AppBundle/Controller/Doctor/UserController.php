<?php

namespace AppBundle\Controller\Doctor;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use AppBundle\Entity\Contact;
use AppBundle\Form\DoctorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/user")
 * @Security("has_role('ROLE_DOCTOR')")
 */
class UserController extends Controller
{
    /**
     * @Route("/edit/{id}", name="doctor_user", requirements={"id": "\d+"})
     */
    public function editAction(Request $request, Contact $contact)
    {
        $form = $this->createForm(DoctorType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
            return $this->redirectToRoute('doctor_homepage');
        }

        return $this->render('doctor/user.html.twig', ['form'=> $form->createView()]);
    }
}


