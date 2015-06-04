<?php

namespace Mask\Predefined\Br;

use Mask\AbstractMask;

class Telefone extends AbstractMask 
{

    public function getStringMask() 
    {
        return '(##) ####-#####';
    }

}
