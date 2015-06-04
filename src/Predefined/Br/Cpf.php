<?php

namespace Mask\Predefined\Br;

use Mask\AbstractMask;

class Cpf extends AbstractMask 
{

    public function getStringMask() 
    {
        return '###.###.###-##';
    }

}