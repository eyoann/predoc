<?php
namespace AppBundle\Security;

use AppBundle\Security\AbstractEmailUserProvider;

class DoctorEmailUserProvider extends AbstractEmailUserProvider
{
    protected function getRole()
    {
        return 'ROLE_DOCTOR';
    }
}
