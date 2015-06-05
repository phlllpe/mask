<?php

namespace Tests\Mask\Predefined\Br;

use Mask\Predefined\Br\Cnpj;
use PHPUnit_Framework_TestCase;

class CnpjTest extends PHPUnit_Framework_TestCase
{
    use \Tests\Mask\Structure\SetUp;

    public function testGetStringMask() 
    {
        $this->assertContains('.', (new Cnpj)->getStringMask());
        $this->assertContains('/', (new Cnpj)->getStringMask());
        $this->assertNotContains('\\', (new Cnpj)->getStringMask());
        $this->assertContains('#', (new Cnpj)->getStringMask());
        $this->assertContains('-', (new Cnpj)->getStringMask());
    }
    
    public function provider()
    {
        return array(
            array('65787304000196'),
            array('6578730400019'),
            array('657873040001'),
            array('65787304000'),
            array('6578730400'),
        );
    }


    /**
     * @dataProvider provider
     */
    public function testMaskDefault($cnpj) 
    {
        $this->assertContains('-', (new Cnpj)->mask($cnpj)->toString());
        $this->assertTrue(strlen($cnpj) < strlen((new Cnpj)->mask($cnpj)->toString()));
    }

    /**
     * @dataProvider provider
     */
    public function testMaskCompleteWith($cnpj) 
    {
        $this->assertContains('-', (new Cnpj)->mask($cnpj, '0', STR_PAD_RIGHT)->toString());
        $this->assertTrue(strlen((new Cnpj)->mask($cnpj)) <= strlen((new Cnpj)->mask($cnpj, '0', STR_PAD_RIGHT)->toString()));
        $this->assertTrue(strlen((new Cnpj)->mask($cnpj)) === strlen((new Cnpj)->mask($cnpj, ' ')->toString()));
    }
    
    public function testMaskReal() 
    {
        $this->assertContains('-', (new Cnpj)->mask('41362586000111')->toString());
        $this->assertContains('.', (new Cnpj)->mask('41362586000111')->toString());
        $this->assertContains('/', (new Cnpj)->mask('41362586000111')->toString());
        $this->assertEquals('41.362.586/0001-11', (new Cnpj)->mask('41362586000111')->toString());
        $this->assertEquals('41.362.586/0000-00', (new Cnpj)->mask('41362586000', '0', STR_PAD_RIGHT)->toString());
        $this->assertEquals('41.362.586/0000-00', (new Cnpj)->mask('41362586', '0', STR_PAD_RIGHT)->toString());
        $this->assertEquals('41.360.000/0000-00', (new Cnpj)->mask('4136', '0', STR_PAD_RIGHT)->toString());
        $this->assertEquals('.   .   /  41-36', (new Cnpj)->mask('4136')->toString());
    }
    
}
