<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\Handler;

use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Util\TokenGeneratorInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RequestStack;

use Symfony\Component\Templating\EngineInterface;

use AppBundle\Entity\User;
use AppBundle\Entity\Contact;
use AppBundle\Form\Model\ContactRegistration;


class RegistrationFormHandler
{
    protected $loginManager;
    protected $request;
    protected $userManager;
    protected $contactManager;
    protected $form;
    protected $tokenGenerator;

    protected $mailer;
    protected $templating;

    protected $user;

    public function __construct(
        FormInterface $form,
        RequestStack $requestStack,
        UserManagerInterface $userManager,
        ObjectManager $contactManager,
        TokenGeneratorInterface $tokenGenerator,
        \Swift_Mailer $mailer,
        EngineInterface $templating

        )
    {
        $this->form = $form;
        $this->request = $requestStack->getCurrentRequest();
        $this->userManager = $userManager;
        $this->contactManager = $contactManager;
        $this->tokenGenerator = $tokenGenerator;
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * @param boolean $confirmation
     */
    public function process($confirmation = false)
    {
        $contactRegistration = new ContactRegistration();
        $this->form->setData($contactRegistration);
        $this->form->handleRequest($this->request);
        if ($this->form->isSubmitted() && $this->form->isValid()) {
            // Try to get the same user from the DB
            $existingUser = $this->userManager->findUserByEmail($contactRegistration->getEmail());

            if ($existingUser !== null){
                return false;
            }
            else{
                $user = new User();
                $user->setUserName($contactRegistration->getEmail());
                $user->setEmail($contactRegistration->getEmail());
                $user->setPlainPassword($contactRegistration->getPlainPassword());
                $user->addRole("ROLE_DOCTOR");
                $user->setEnabled(true);
                $this->user = $user;
                $date = new \DateTime();
                $contact = new Contact();
                $contact->setUser($user);
                $contact->setLastname($contactRegistration->getLastname());
                $contact->setFirstname($contactRegistration->getFirstname());
                $contact->setRpps($contactRegistration->getRpps());
                $contact->setPhone($contactRegistration->getPhone());
                $contact->setAddress1($contactRegistration->getAddress1());
                $contact->setAddress2($contactRegistration->getAddress2());
                $contact->setAddress3($contactRegistration->getAddress3());
                $contact->setZipcode($contactRegistration->getZipcode());
                $contact->setCity($contactRegistration->getCity());
                $contact->setCountry($contactRegistration->getCountry());
                $contact->addSpecialisation($contactRegistration->getSpecialisation());
                $contact->setCreated($date);
                $contact->setUpdated($date);


                $this->contactManager->persist($contact);

                // Flush done here
                // TODO !!!!
                //$this->onSuccess($user, $confirmation);
                //
                //
                $message = \Swift_Message::newInstance()
                    ->setSubject('Vérification d\'inscription')
                    ->setFrom('predoc.contact@gmail.fr')
                    ->setTo($contactRegistration->getEmail())
                    ->setBody(
                        $this->templating->render('administrator/mail.html.twig', array('name' => $contactRegistration->getFirstname(), 'date' => $date, 'rpps' => $contactRegistration->getRpps())),
                        'text/html'
                    )
                ;
                //die(dump($message));
                $this->mailer->send($message);

                return true;
            }
        }

        return false;
    }

    /**
     * @return \FOS\UserBundle\Model\UserInterface
     */
    public function getUser(){
        return $this->user;
    }
}