<?php

namespace Tests\Mask\Predefined\Br;

use Mask\Predefined\Br\Cep;
use PHPUnit_Framework_TestCase;

class CepTest extends PHPUnit_Framework_TestCase
{
    use \Tests\Mask\Structure\SetUp;

    public function testGetStringMask() 
    {
        $this->assertNotContains('.', (new Cep)->getStringMask());
        $this->assertNotContains('/', (new Cep)->getStringMask());
        $this->assertNotContains('\\', (new Cep)->getStringMask());
        $this->assertContains('#', (new Cep)->getStringMask());
        $this->assertContains('-', (new Cep)->getStringMask());
    }
    
    public function provider()
    {
        return array(
            array('58015050'),
            array('58015010'),
            array('5801501'),
            array('580150'),
            array('58015'),
        );
    }


    /**
     * @dataProvider provider
     */
    public function testMaskDefault($cep) 
    {
        $this->assertContains('-', (new Cep)->mask($cep)->toString());
        $this->assertTrue(strlen($cep) < strlen((new Cep)->mask($cep)->toString()));
    }

    /**
     * @dataProvider provider
     */
    public function testMaskCompleteWith($cep) 
    {
        $this->assertContains('-', (new Cep)->mask($cep, '0', STR_PAD_RIGHT)->toString());
        $this->assertTrue(strlen((new Cep)->mask($cep)) <= strlen((new Cep)->mask($cep, '0', STR_PAD_RIGHT)->toString()));
        $this->assertTrue(strlen((new Cep)->mask($cep)) === strlen((new Cep)->mask($cep, ' ')->toString()));
    }
    
    public function testMaskReal() 
    {
        $cep = '58015050';
        $this->assertContains('-', (new Cep)->mask($cep)->toString());
        $this->assertEquals('58015-050', (new Cep)->mask($cep)->toString());
        $this->assertEquals('58015-000', (new Cep)->mask('58015', '0', STR_PAD_RIGHT)->toString());
        $this->assertEquals('58010-000', (new Cep)->mask('58010', '0', STR_PAD_RIGHT)->toString());
        $this->assertEquals('58000-000', (new Cep)->mask('580', '0', STR_PAD_RIGHT)->toString());
        $this->assertEquals('-580', (new Cep)->mask('580')->toString());
    }
    
}
