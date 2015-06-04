<?php

namespace Mask\Predefined\Br;

use Mask\AbstractMask;

class Cnpj extends AbstractMask 
{

    public function getStringMask() 
    {
        return '##.###.###/####-##';
    }

}
