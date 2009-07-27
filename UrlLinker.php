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

/*
 *  Regular expression bits used by htmlEscapeAndLinkUrls() to match URLs.
 */
$rexProtocol  = '(https?://)?';
$rexDomain    = '((?:[-a-zA-Z0-9]{1,63}\.)+[-a-zA-Z0-9]{2,63}|(?:[0-9]+\.){3}[0-9]+)';
$rexPort      = '(:[0-9]{1,5})?';
$rexPath      = '(/[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]*?)?';
$rexQuery     = '(\?[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]+?)?';
$rexFragment  = '(#[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]+?)?';
$rexUrlLinker = "{\\b$rexProtocol$rexDomain$rexPort$rexPath$rexQuery$rexFragment(?=[?.!,;:\"]?(\s|$))}";

function callback($match)
{
    if (!$match[1]) $match[1] = 'http://';
    if (!$match[3]) $match[3] = '';
    if (!$match[4]) $match[4] = '';
    if (!$match[5]) $match[5] = '';
    if (!$match[6]) $match[6] = '';

    return '<a href="' . $match[1] . $match[2] . $match[3] . $match[4] . $match[5] . $match[6] . '">'
        . $match[2] . $match[3] . $match[4] . '</a>';
}

/**
 *  Transforms plain text into valid HTML, escaping special characters and
 *  turning URLs into links.
 */
function htmlEscapeAndLinkUrls($text)
{
    global $rexUrlLinker;
    return preg_replace_callback($rexUrlLinker, 'callback', htmlspecialchars($text));
}
