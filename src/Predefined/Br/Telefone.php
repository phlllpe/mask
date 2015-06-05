<?php

namespace Mask\Predefined\Br;

use Mask\AbstractMask;

/**
 * 
 */
class Telefone extends AbstractMask 
{
    
    /**
     * 
     * @return string
     */
    public function getStringMask() 
    {
        return '(##) ####-#####';
    }

}
