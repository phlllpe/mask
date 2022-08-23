<?php

namespace Mask\Predefined\Br;

use Mask\AbstractMask;

class LinhaDigitavel extends AbstractMask
{
    public function getStringMask()
    {
        return '#####.##### #####.###### #####.###### # ##############';
    }
}
