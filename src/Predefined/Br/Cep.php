<?php

namespace Mask\Predefined\Br;

use Mask\AbstractMask;

class Cep extends AbstractMask 
{

    public function getStringMask() 
    {
        return '#####-###';
    }

}
