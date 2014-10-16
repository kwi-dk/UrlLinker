<?php

/**
 * UrlLinker - facilitates turning plain text URLs into HTML links.
 *
 * Author: Søren Løvborg
 *
 * To the extent possible under law, Søren Løvborg has waived all copyright
 * and related or neighboring rights to UrlLinker.
 * http://creativecommons.org/publicdomain/zero/1.0/
 */

/**
 * Transforms plain text into valid HTML, escaping special characters and
 * turning URLs into links.
 *
 * @param string $text
 * @return string
 */
function htmlEscapeAndLinkUrls($text)
{
    return \Kwi\UrlLinker::getInstance()->linkUrlsAndEscapeHtml($text);
}

/**
 * Turns URLs into links in a piece of valid HTML/XHTML.
 *
 * Beware: Never render HTML from untrusted sources. Rendering HTML provided by
 * a malicious user can lead to system compromise through cross-site scripting.
 *
 * @param string $html
 * @return string
 */
function linkUrlsInTrustedHtml($html)
{
    return \Kwi\UrlLinker::getInstance()->linkUrlsInTrustedHtml($html);
}
