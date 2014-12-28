<?php

class HtmlEscapeAndLinkUrlsTest extends UrlLinkerTestCase
{
    public function testExample()
    {
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

        $expected = <<<EOD
Here's an e-mail-address:<a href="mailto:bob+test&#64;example.org">bob+test&#64;example.org</a>. Here's an authenticated URL: <a href="http://skroob:12345&#64;example.com">example.com</a>.
Here are some URLs:
<a href="http://stackoverflow.com/questions/1188129/pregreplace-to-detect-html-php">stackoverflow.com/questions/1188129/pregreplace-to-detect-html-php</a>
Here's the answer: <a href="http://www.google.com/search?rls=en&amp;q=42&amp;ie=utf-8&amp;oe=utf-8&amp;hl=en">www.google.com/search</a>. What was the question?
A quick look at '<a href="http://en.wikipedia.org/wiki/URI_scheme#Generic_syntax">en.wikipedia.org/wiki/URI_scheme</a>' is helpful.
There is no place like <a href="http://127.0.0.1">127.0.0.1</a>! Except maybe <a href="http://news.bbc.co.uk/1/hi/england/surrey/8168892.stm">news.bbc.co.uk/1/hi/england/surrey/8168892.stm</a>?
Ports: <a href="http://192.168.0.1:8080">192.168.0.1:8080</a>, <a href="https://example.net:1234/">example.net:1234/</a>.
Beware of Greeks bringing internationalized top-level domains (xn--hxajbheg2az3al.xn--jxalpdlp).
10.000.000.000 is not an IP-address. Nor is this.a.domain.

&lt;script&gt;alert('Remember kids: Say no to XSS-attacks! Always HTML escape untrusted input!');&lt;/script&gt;

<a href="https://mail.google.com/mail/u/0/#starred?compose=141d598cd6e13025">mail.google.com/mail/u/0/</a>
<a href="https://www.google.com/search?q=bla%20bla%20bla">www.google.com/search</a>
<a href="https://www.google.com/search?q=bla+bla+bla">www.google.com/search</a>

We need to support IDNs and IRIs and röck döts:
<a href="http://møøse.kwi.dk/阿驼鹿一旦咬了我的妹妹/من-اليمين-إلى-اليسار-لغات-تخلط-لي">møøse.kwi.dk/阿驼鹿一旦咬了我的妹妹/من-اليمين-إلى-اليسار-لغات-تخلط-لي</a>.
EOD;

        $this->assertSame($expected, $this->linkify($text));
    }

    /**
     * @dataProvider provideTextsWithLinksWithoutHtml
     *
     * @param string      $text
     * @param string      $expectedLinked
     * @param string|null $message
     */
    public function testUrlsGetLinkedInText($text, $expectedLinked, $message = null)
    {
        $this->assertSame(
            $expectedLinked,
            $this->linkify($text),
            'Simple case: '.$message
        );

        $this->assertSame(
            sprintf('foo %s bar', $expectedLinked),
            $this->linkify(sprintf('foo %s bar', $text)),
            'Text around: '.$message
        );

        // html should get encoded
        $this->assertSame(
            sprintf('&lt;div class=&quot;test&quot;&gt; %s &lt;/div&gt;', $expectedLinked),
            $this->linkify(sprintf('<div class="test"> %s </div>', $text)),
            'Html around: '.$message
        );
    }

    /**
     * @param string $text
     * @return string
     */
    protected function linkify($text)
    {
        return htmlEscapeAndLinkUrls($text);
    }
}
