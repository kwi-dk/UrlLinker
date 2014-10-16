<?php

namespace Kwi;

class UrlLinker implements UrlLinkerInterface
{
    /**
     * @param string $text
     * @return string
     */
    public function linkUrlsAndEscapeHtml($text)
    {
        return htmlEscapeAndLinkUrls($text);
    }

    /**
     * @param string $text
     * @return string
     */
    public function linkUrlsInTrustedHtml($text)
    {
        return linkUrlsInTrustedHtml($text);
    }
}
