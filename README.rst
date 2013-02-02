UrlLinker
=========

UrlLinker is a PHP module for converting plain text snippets to HTML, and any
web addresses in the text into HTML hyperlinks.

Usage::

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

  - To reduce false positives, UrlLinker verifies that the top-level domain is
    on the official IANA list of valid TLDs.

    - UrlLinker is updated from time to time as the TLD list is expanded.

    - In the future, this approach may collapse under ICANN's ill-advised new
      policy of selling arbitrary TLDs for large amounts of cash, but for now
      it is an effective method of rejecting invalid URLs.

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
