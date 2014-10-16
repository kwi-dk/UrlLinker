<?php

namespace Kwi;

interface UrlLinkerInterface
{
    /**
     * @param string $text
     * @return string
     */
    public function linkUrlsAndEscapeHtml($text);

    /**
     * @param string $text
     * @return string
     */
    public function linkUrlsInTrustedHtml($text);
}
