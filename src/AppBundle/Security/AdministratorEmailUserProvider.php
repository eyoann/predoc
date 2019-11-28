<?php
namespace AppBundle\Security;

use AppBundle\Security\AbstractEmailUserProvider;

class AdministratorEmailUserProvider extends AbstractEmailUserProvider
{
    protected function getRole()
    {
        return 'ROLE_ADMIN';
    }
}
