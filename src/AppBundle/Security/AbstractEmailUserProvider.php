<?php
namespace AppBundle\Security;

use FOS\UserBundle\Security\UserProvider;

abstract class AbstractEmailUserProvider extends UserProvider
{

    protected abstract function getRole();

    protected function findUser($username)
    {
        $user = $this->userManager->findUserByUsernameOrEmail($username);
        if (!$user) {
            return;
        }

        if (in_array($this->getRole(), $user->getRoles())) {
            return $user;
        }
    }
}