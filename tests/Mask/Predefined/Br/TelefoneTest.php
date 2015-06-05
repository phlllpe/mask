<?php

namespace Tests\Mask\Predefined\Br;

use Mask\Predefined\Br\Telefone;
use PHPUnit_Framework_TestCase;

class TelefoneTest extends PHPUnit_Framework_TestCase
{
    use \Tests\Mask\Structure\SetUp;

    public function testGetStringMask() 
    {
        $this->assertNotContains('.', (new Telefone)->getStringMask());
        $this->assertNotContains('/', (new Telefone)->getStringMask());
        $this->assertNotContains('\\', (new Telefone)->getStringMask());
        $this->assertContains('#', (new Telefone)->getStringMask());
        $this->assertContains('-', (new Telefone)->getStringMask());
        $this->assertContains('(', (new Telefone)->getStringMask());
        $this->assertContains(')', (new Telefone)->getStringMask());
    }
    
    public function provider()
    {
        return array(
            array('083988117558'),
            array('08388117558'),
            array('0839881175'),
            array('08398811'),
            array('08398'),
            array('0839'),
        );
    }


    /**
     * @dataProvider provider
     */
    public function testMaskDefault($telefone) 
    {
        $this->assertContains('-', (new Telefone)->mask($telefone));
        $this->assertTrue(strlen($telefone) < strlen((new Telefone)->mask($telefone)));
    }

    /**
     * @dataProvider provider
     */
    public function testMaskCompleteWith($telefone) 
    {
        $this->assertContains('-', (new Telefone)->mask($telefone, '0', STR_PAD_RIGHT));
        $this->assertTrue(strlen((new Telefone)->mask($telefone)) <= strlen((new Telefone)->mask($telefone, '0', STR_PAD_RIGHT)));
        $this->assertTrue(strlen((new Telefone)->mask($telefone)) === strlen((new Telefone)->mask($telefone, ' ')));
    }
    
    public function testMaskReal() 
    {
        $telefone = '83988117558';
        $this->assertContains('-', (new Telefone)->mask($telefone));
        $this->assertEquals('(83) 9881-17558', (new Telefone)->mask($telefone));
        $this->assertEquals('(83) 9881-10000', (new Telefone)->mask('8398811', '0', STR_PAD_RIGHT));
        $this->assertEquals('(83) 9881-00000', (new Telefone)->mask('839881', '0', STR_PAD_RIGHT));
        $this->assertEquals('(83) 0000-00000', (new Telefone)->mask('83', '0', STR_PAD_RIGHT));
        $this->assertEquals('(  )     -   83', (new Telefone)->mask('83'));
    }
    
}
