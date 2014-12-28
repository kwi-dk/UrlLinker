UrlLinker
=========

UrlLinker is a PHP module for converting plain text snippets to HTML, and any
web addresses in the text into HTML hyperlinks.


Installing
------------

1. Download the lib using [Composer](https://getcomposer.org/):

    ```
    composer require kwi/urllinker
    ```

2. In your PHP file require Composer's autoloader:

    ```
    <?php

    require_once __DIR__.'/vendor/autoload.php';
    ```


Usage (procedural API)
----------------------

    print(htmlEscapeAndLinkUrls($text));

For a longer example, see `UrlLinker-example.php`__.

__ https://bitbucket.org/kwi/urllinker/src/tip/UrlLinker-example.php

UrlLinker assumes plain text input, and returns HTML. If your input is already
HTML, but it contains URLs that have not been marked up, UrlLinker can handle
that as well::

    print(linkUrlsInTrustedHtml($html));

Warning: The latter function must *only* be used on trusted input, as rendering
HTML provided by a malicious user can lead to system compromise through
`cross-site scripting`__. The ``htmlEscapeAndLinkUrls`` function, on the other
hand, can safely be used on untrusted input. (You can remove existing tags from
untrusted input via PHP's `strip_tags`__ function.)

__ http://en.wikipedia.org/wiki/Cross-site_scripting
__ http://php.net/strip-tags


Usage (object oriented API)
---------------------------

```
$urlLinker = new Kwi\UrlLinker();

$urlLinker->linkUrlsAndEscapeHtml($text);

$urlLinker->linkUrlsInTrustedHtml($html);
```

In your functions, you can depend on `UrlLinkerInterface`:

```
class Example
{
    private $urlLinker;

    public function __construct(Kwi\UrlLinkerInterface $urlLinker)
    {
        $this->urlLinker = $urlLinker;
    }

    public function doStuff($text)
    {
        // do sth with $text…

        return $this->urlLinker->linkUrlsAndEscapeHtml($text);
    }
}
```

You can configure different options for parsing URLs by passing them into `UrlLinker`'s constructor:

```
// Ftp addresses like "ftp://example.com" will be allowed:
$urlLinker = new Kwi\UrlLinker(true);

// Uppercase URL schemes like "HTTP://exmaple.com" will be allowed:
$urlLinker = new Kwi\UrlLinker(false, true);
```


Recognized addresses
--------------------

- Web addresses

  - Recognized URL schemes: "http" and "https"

    - The ``http://`` prefix is optional.

    - Support for additional schemes, e.g. "ftp", can easily be added by
      tweaking ``$rexScheme``.

    - The scheme must be written in lower case. This requirement can be lifted
      by adding an ``i`` (the ``PCRE_CASELESS`` modifier) to ``$rexUrlLinker``.

  - Hosts may be specified using domain names or IPv4 addresses.

    - IPv6 addresses are not supported.

  - Port numbers are allowed.

  - Internationalized Resource Identifiers (IRIs) are allowed. Note that the
    job of converting IRIs to URIs is left to the user's browser.

  - To reduce false positives, UrlLinker verifies that the top-level domain is
    on the official IANA list of valid TLDs.

    - UrlLinker is updated from time to time as the TLD list is expanded.

    - In the future, this approach may collapse under ICANN's ill-advised new
      policy of selling arbitrary TLDs for large amounts of cash, but for now
      it is an effective method of rejecting invalid URLs.

    - Internationalized *top-level* domain names must be written in Punycode in
      order to be recognized.

    - If you need to support unqualified domain names, such as ``localhost``,
      you may disable the TLD check by 1) replacing ``+`` with ``*`` in the
      ``$rexDomain`` value and 2) replacing the ``if`` statement line beneath
      the "Check that the TLD is valid" comment with ``if (true)``. This is
      obviously a quick-and-dirty hack, and may cause false positives.

- Email addresses

  - Supports the full range of commonly used address formats, including "plus
    addresses" (as popularized by Gmail).

  - Does not recognized the more obscure address variants that are allowed by
    the RFCs but never seen in practice.

  - Simplistic spam protection: The at-sign is converted to a HTML entity,
    foiling naive email address harvesters.

- Addresses are recognized correctly in normal sentence contexts. For instance,
  in "Visit stackoverflow.com.", the final period is not part of the URL.

- User input is properly sanitized to prevent `cross-site scripting`__ (XSS),
  and ampersands in URLs are `correctly escaped`__ as ``&amp;`` (this does not
  apply to the ``linkUrlsInTrustedHtml`` function, which assumes its input to
  be valid HTML).

__ http://en.wikipedia.org/wiki/Cross-site_scripting
__ http://www.htmlhelp.com/tools/validator/problems.html#amp


Tests
-----

Unit tests are written using [PHPUnit](https://phpunit.de).

```
$ cd PATH_TO_URL_LINKER
$ composer install
$ phpunit
```

Background
----------

A `Stackoverflow.com question`__ prompted me to consider the difficulty of this
task. Initially, it seemed easy, but like an itch you just have to scratch, I
kept coming back to it, to fix just one more little thing.

__ http://stackoverflow.com/questions/1188129/replace-urls-in-text-with-html-links/

Feel free to upvote my answer if you find this code useful.

There's also a `C# implementation`__ by Antoine Sottiau.

__ http://codepaste.net/ngamud


Public Domain Dedication
------------------------

To the extent possible under law, the author has waived all copyright and
related or neighboring rights to UrlLinker.

For more information see:
http://creativecommons.org/publicdomain/zero/1.0/
