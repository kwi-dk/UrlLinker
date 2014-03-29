<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>UrlLinker Example</title>
</head>
<body>
<!-- Plain text input -->
<p>
<?php

require("UrlLinker.php");

$text = <<<EOD
Here's an e-mail-address:bob+test@example.org. Here's an authenticated URL: http://skroob:12345@example.com.
Here are some URLs:
stackoverflow.com/questions/1188129/pregreplace-to-detect-html-php
Here's the answer: http://www.google.com/search?rls=en&q=42&ie=utf-8&oe=utf-8&hl=en. What was the question?
A quick look at 'http://en.wikipedia.org/wiki/URI_scheme#Generic_syntax' is helpful.
There is no place like 127.0.0.1! Except maybe http://news.bbc.co.uk/1/hi/england/surrey/8168892.stm?
Ports: 192.168.0.1:8080, https://example.net:1234/.
Beware of Greeks bringing internationalized top-level domains (xn--hxajbheg2az3al.xn--jxalpdlp).
10.000.000.000 is not an IP-address. Nor is this.a.domain.

<script>alert('Remember kids: Say no to XSS-attacks! Always HTML escape untrusted input!');</script>

https://mail.google.com/mail/u/0/#starred?compose=141d598cd6e13025
https://www.google.com/search?q=bla%20bla%20bla
https://www.google.com/search?q=bla+bla+bla

We need to support IDNs and IRIs and röck döts:
møøse.kwi.dk/阿驼鹿一旦咬了我的妹妹/من-اليمين-إلى-اليسار-لغات-تخلط-لي.
EOD;

print(nl2br(htmlEscapeAndLinkUrls($text)));
?>
</p>
<!-- HTML input -->
<?php
$html = <<<EOD
<p>Send me an <a href="bob@example.com">e-mail</a> at bob@example.com.</p>
<p>This is already a link: <a href="http://google.com">http://google.com</a></p>
<p title='10>20'>Tricky markup...</p>
EOD;
print(linkUrlsInTrustedHtml($html));
?>
</body>
</html>
