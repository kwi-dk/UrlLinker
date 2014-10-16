<?php

use Kwi\UrlLinker;

class UrlLinkerTest extends PHPUnit_Framework_TestCase
{
    public function testItImplementsUrlLinkerInterface()
    {
        $this->assertInstanceOf('Kwi\UrlLinkerInterface', new UrlLinker());
    }

    public function testGetInstanceReturnsUrlLinkerSingleton()
    {
        $urlLinkerSingleton1 = UrlLinker::getInstance();
        $urlLinkerSingleton2 = UrlLinker::getInstance();

        $this->assertSame(
            $urlLinkerSingleton1,
            $urlLinkerSingleton2,
            'Should always return the same instance (singleton)'
        );

        $this->assertInstanceOf('Kwi\UrlLinker', $urlLinkerSingleton1);

        $this->assertNotSame(new UrlLinker(), $urlLinkerSingleton1);
    }
}
