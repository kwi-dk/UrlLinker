<?php

namespace Kwi;

class UrlLinker implements UrlLinkerInterface
{
    /**
     * @var UrlLinker|null
     */
    private static $instance;

    public static function getInstance()
    {
        if (!static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

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
