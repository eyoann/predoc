<?php
namespace AppBundle\Controller\Doctor;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContext;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FilterUserResponseEvent;

use FOS\UserBundle\Controller\RegistrationController as RegistrationControllerBase;

class RegistrationController extends RegistrationControllerBase
{
    public function registerAction(Request $request)
    {
        $form = $this->container->get('doctor_fos_user.registration.form');
        $formHandler = $this->container->get('doctor_fos_user.registration.form.handler');
        $dispatcher = $this->get('event_dispatcher');

        $confirmationEnabled = false;
        $process = $formHandler->process($confirmationEnabled);

        if ($process) {
            $user = $formHandler->getUser();
            //$this->setFlash('fos_user_success', 'registration.flash.user_created');

            $route = 'doctor_homepage';// 'fos_user_registration_confirmed';
            $url = $this->container->get('router')->generate($route);
            $response = new RedirectResponse($url);

            //$this->authenticateUser($user, $response);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
            $manager = $this->get('manager.user');
            $user->setEnabled(false);
            $manager->persist($user);
            $manager->flush();
            return $response;
        }
        return $this->container->get('templating')->renderResponse('doctor/new.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}
