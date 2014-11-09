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

    public function testAllowingFtpAddresses()
    {
        $urlLinker = new UrlLinker(true);

        $text = '<div>ftp://example.com</div>';
        $expectedText = '&lt;div&gt;<a href="ftp://example.com">example.com</a>&lt;/div&gt;';

        $this->assertSame($expectedText, $urlLinker->linkUrlsAndEscapeHtml($text));

        $html = '<div>ftp://example.com</div>';
        $expectedHtml = '<div><a href="ftp://example.com">example.com</a></div>';

        $this->assertSame($expectedHtml, $urlLinker->linkUrlsInTrustedHtml($html));
    }

    public function testAllowingUpperCaseSchemes()
    {
        $urlLinker = new UrlLinker(false, true);

        $text = '<div>HTTP://example.com</div>';
        $expectedText = '&lt;div&gt;<a href="HTTP://example.com">example.com</a>&lt;/div&gt;';

        $this->assertSame($expectedText, $urlLinker->linkUrlsAndEscapeHtml($text));

        $html = '<div>HTTP://example.com</div>';
        $expectedHtml = '<div><a href="HTTP://example.com">example.com</a></div>';

        $this->assertSame($expectedHtml, $urlLinker->linkUrlsInTrustedHtml($html));
    }
}
