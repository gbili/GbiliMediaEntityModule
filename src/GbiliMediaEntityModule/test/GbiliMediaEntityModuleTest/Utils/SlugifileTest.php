<?php
namespace GbiliMediaEntityModuleTest\Utils;

class SlugifileTest extends \PHPUnit_Framework_TestCase
{
    public function testSlugifileReceivesInput()
    {
        $input = 'myinput.jk';
        $s = new \GbiliMediaEntityModule\Utils\Slugifile($input);
        $this->assertEquals($input, $s->getInput());

        $input = 'otherinput.jk';
        $s->setInput($input);
        $this->assertEquals($input, $s->getInput());
    }

    public function testSlugifileBreaksPartsCorrectly()
    {
        $input = 'myinput.jk';
        $parts = explode($input, '.');
        $basename = $parts[0];
        $ext = $parts[1];
        $s = new \GbiliMediaEntityModule\Utils\Slugifile($input);
        $this->assertEquals($basename, $s->getBasename());
        $this->assertEquals($ext, $s->getExtension());
    }
}
