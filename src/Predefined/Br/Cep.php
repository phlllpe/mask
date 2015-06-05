<?php

namespace Mask\Predefined\Br;

use Mask\AbstractMask;

/**
 * 
 */
class Cep extends AbstractMask 
{

    /**
     * 
     * @return string
     */
    public function getStringMask() 
    {
        return '#####-###';
    }

}
