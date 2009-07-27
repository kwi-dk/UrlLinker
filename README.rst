UrlLinker
=========

UrlLinker is a PHP module for converting plain text to HTML, and any URLs in
the text into HTML links.

A `Stackoverflow.com question`__ prompted me to consider the difficulty of such
a task. Initially, it seemed easy, but like an itch you just have to scratch, I
kept coming back to it, to fix just one more little thing. I'm pretty happy
about the final result.

__ http://stackoverflow.com/questions/1188129/replace-urls-in-text-with-html-links/

Feel free to upvote my answer if you find this code useful.

Usage::

    print(htmlEscapeAndLinkUrls($text));


Longer example
--------------

For a longer example, see `UrlLinker-example.php`_.

.. _UrlLinker-example.php: https://bitbucket.org/kwi/urllinker/src/tip/UrlLinker-example.php


License
-------

To the extent possible under law, the author has waived all copyright and
related or neighboring rights to WsgiUnproxy.

For more information see:
http://creativecommons.org/publicdomain/zero/1.0/
