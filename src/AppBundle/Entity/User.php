<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser
{
    protected $id;
    private $contact;

    public function getContact()
    {
        return $this->contact;
    }

    public function affectRole($oldRoles, $listRoles) {
        $newListeRoles = [];
        foreach ($listRoles as $index) {
            $newListeRoles[] = $index;
        }

        $roles = [];
        foreach ($oldRoles as $oldRole) {
            if (!in_array($oldRole, $newListeRoles)) {
                $roles[] = $oldRole;
            }
        }

        $this->roles += $roles;
    }
}
