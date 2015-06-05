<?php

namespace Mask\Predefined\Br;

use Mask\AbstractMask;

/**
 * 
 */
class Cnpj extends AbstractMask 
{
    /**
     * 
     * @return string
     */
    public function getStringMask() 
    {
        return '##.###.###/####-##';
    }

}
