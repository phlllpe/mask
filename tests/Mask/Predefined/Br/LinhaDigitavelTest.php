<?php

namespace Tests\Mask\Predefined\Br;

use Mask\Predefined\Br\LinhaDigitavel;
use PHPUnit_Framework_TestCase;

class LinhaDigitavelTest extends PHPUnit_Framework_TestCase
{
    use \Tests\Mask\Structure\SetUp;

    public function testGetStringMask()
    {
        $this->assertContains('.', (new LinhaDigitavel)->getStringMask());
        $this->assertContains('#', (new LinhaDigitavel)->getStringMask());
        $this->assertNotContains('/', (new LinhaDigitavel)->getStringMask());
        $this->assertNotContains('\\', (new LinhaDigitavel)->getStringMask());
        $this->assertNotContains('-', (new LinhaDigitavel)->getStringMask());
    }

    public function provider()
    {
        return [
            ['00190000090312855701821548161179591160000002222'],
        ];
    }

    /**
     * @dataProvider provider
     */
    public function testMaskDefault($linhaDigitavel)
    {
        $this->assertContains('.', (new LinhaDigitavel)->mask($linhaDigitavel)->toString());
        $this->assertTrue(strlen($linhaDigitavel) < strlen((new LinhaDigitavel)->mask($linhaDigitavel)->toString()));
    }

    /**
     * @dataProvider provider
     */
    public function testMaskReal($linhaDigitavel)
    {
        $this->assertContains('.', (new LinhaDigitavel)->mask($linhaDigitavel)->toString());
        $this->assertEquals('00190.00009 03128.557018 21548.161179 5 91160000002222', (new LinhaDigitavel)->mask($linhaDigitavel)->toString());
    }
}
