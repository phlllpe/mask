<?php

namespace Tests\Mask\Mock;

use Mask\AbstractMask;

class Wrong extends AbstractMask
{
    
    public function getStringMask() 
    {
        return null;
    }

}
