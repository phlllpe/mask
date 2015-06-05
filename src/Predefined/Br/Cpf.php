<?php

namespace Mask\Predefined\Br;

use Mask\AbstractMask;

/**
 * 
 */
class Cpf extends AbstractMask 
{
    
    /**
     * 
     * @return string
     */
    public function getStringMask() 
    {
        return '###.###.###-##';
    }

}
