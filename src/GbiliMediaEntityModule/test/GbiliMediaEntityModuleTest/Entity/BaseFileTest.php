<?php
namespace GbiliMediaEntityModuleTest\Entity;

class BaseFileTest extends \PHPUnit_Framework_TestCase
{
    protected $entity;
    protected function setUp()
    {
        $this->entity = new \GbiliMediaEntityModule\Entity\BaseFile();
    }

    public function testSlugifyMethod()
    {
        $accepted = array(
            'thisis.jpg',
            'this-is.jpg',
            'this_is.jpg',
        );
        $this->entity->slugify();
    }
}
