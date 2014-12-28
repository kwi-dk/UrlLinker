<?php

use Kwi\UrlLinker;

class UrlLinkerInTrustedHtmlTest extends LinkUrlsInTrustedHtmlTest
{
    /**
     * @var UrlLinker
     */
    private $urlLinker;

    protected function setUp()
    {
        $this->urlLinker = new UrlLinker();
    }

    /**
     * @param string $text
     */
    protected function linkify($text)
    {
        return $this->urlLinker->linkUrlsInTrustedHtml($text);
    }
}
