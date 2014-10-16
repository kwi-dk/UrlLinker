<?php

use Kwi\UrlLinker;

class UrlLinkerEscapingHtmlTest extends HtmlEscapeAndLinkUrlsTest
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
        return $this->urlLinker->linkUrlsAndEscapeHtml($text);
    }
}
