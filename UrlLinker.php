<?php

/**
 *  UrlLinker - facilitates turning plain text URLs into HTML links.
 *
 *  Author: Søren Løvborg
 *
 *  To the extent possible under law, Søren Løvborg has waived all copyright
 *  and related or neighboring rights to UrlLinker.
 *  http://creativecommons.org/publicdomain/zero/1.0/
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
 */
function linkUrlsInTrustedHtml($html)
{
    $reMarkup = '{</?([a-z]+)([^"\'>]|"[^"]*"|\'[^\']*\')*>|&#?[a-zA-Z0-9]+;|$}';

    $insideAnchorTag = false;
    $position = 0;
    $result = '';

    // Iterate over every piece of markup in the HTML.
    while (true) {
        $match = array();
        preg_match($reMarkup, $html, $match, PREG_OFFSET_CAPTURE, $position);

        list($markup, $markupPosition) = $match[0];

        // Process text leading up to the markup.
        $text = substr($html, $position, $markupPosition - $position);

        // Link URLs unless we're inside an anchor tag.
        if (!$insideAnchorTag) {
            $text = htmlEscapeAndLinkUrls($text);
        }

        $result .= $text;

        // End of HTML?
        if ($markup === '') {
            break;
        }

        // Check if markup is an anchor tag ('<a>', '</a>').
        if ($markup[0] !== '&' && $match[1][0] === 'a') {
            $insideAnchorTag = ($markup[1] !== '/');
        }

        // Pass markup through unchanged.
        $result .= $markup;

        // Continue after the markup.
        $position = $markupPosition + strlen($markup);
    }

    return $result;
}
