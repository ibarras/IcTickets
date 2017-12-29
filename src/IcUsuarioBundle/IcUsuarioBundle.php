<?php

namespace IcUsuarioBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class IcUsuarioBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
