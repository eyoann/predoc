<?php

namespace AppBundle\Controller\Administrator;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @Route("/user")
 * @Security("has_role('ROLE_ADMIN')")
 */
class UserController extends Controller
{
	/**
     * @Route("/", name="list_user")
     */
    public function listAction(Request $request)
    {
    	//on a besoin du service depuis entity.yml
    	$repository = $this->get('repository.contact');
    	$listcontact = $repository->findAll();

    	return $this->render('administrator/listuser.html.twig', ['contacts' => $listcontact]);
    }
    /**
     * @Route("/edit/{id}", name="edit_user", requirements={"id": "\d+"})
     */
    public function editAction(Request $request, Contact $contact)
    {

        $form = $this->createForm(ContactType::class, $contact);

        $user = $contact->getUser();
        $oldRoles = $user->getRoles();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->get('manager.user');
            $user->affectRole($oldRoles, $form->get('user')->get('roles')->getConfig()->getOption('choices'));
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('list_user');
        }
        return $this->render('administrator/editUser.html.twig', ['form'=> $form->createView()]);
    }

    /**
     * @Route("/add", name="add_user")
     */
    public function ajouterAction(Request $request)
    {
        $form = $this->container->get('doctor_fos_user.registration.form');
        $formHandler = $this->container->get('doctor_fos_user.registration.form.handler');
        $dispatcher = $this->get('event_dispatcher');

        $confirmationEnabled = false;
        $process = $formHandler->process($confirmationEnabled);
        $manager = $this->get('manager.user');

        if ($process) {
            $user = $formHandler->getUser();

            $user->setRoles(array('ROLE_ADMIN'));
            $manager->persist($user);
            $manager->flush();
            //$this->setFlash('fos_user_success', 'registration.flash.user_created');

            $route = 'admin_homepage';// 'fos_user_registration_confirmed';
            $url = $this->container->get('router')->generate($route);
            $response = new RedirectResponse($url);


            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
            return $response;
        }
        return $this->container->get('templating')->renderResponse('administrator/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}


