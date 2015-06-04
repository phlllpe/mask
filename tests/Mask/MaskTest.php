<?php

namespace Tests\Mask;

use Mask\Exception\InvalidArgumentException;
use Tests\Mask\Mock\Wrong;
use Tests\Mask\Mock\CepWithoutTrim;
use Mask\Predefined\Br\Cep;
use PHPUnit_Framework_TestCase;

class MaskTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowException()
    {
        (new Wrong())->mask('any value');
    }
    
    public function testToStringWithTrim()
    {
        $cep = (new Cep);
        $cep->mask('58015000');
        "{$cep}";
    }
    
    public function testToStringWithoutTrim()
    {
        $cep = (new CepWithoutTrim);
        $cep->mask('58015000');
        "{$cep}";
    }
}   