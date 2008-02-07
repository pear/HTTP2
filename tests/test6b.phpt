--TEST--
absoluteURI() URL: http://example.org/subdir/
--GET--
--ENV--
HTTP_HOST=example.org
SERVER_NAME=example.org
SERVER_PORT=80
REQUEST_URI=/subdir/
SCRIPT_NAME=/subdir/index.php
--FILE--
<?php
/**
 * All relative URI should resolve to current URI top-most folder
 *
 * In this test: /subdir/
 */
define('HTTP_RELATIVETOSCRIPT', false);
include 'absoluteURI.inc';
?>
--EXPECT--
||                     => http://example.org/subdir/
?new=value||           => http://example.org/subdir/?new=value
#anchor||              => http://example.org/subdir/#anchor
/page.html||           => http://example.org/page.html
page.html||            => http://example.org/subdir/page.html
page.html|http|        => http://example.org/subdir/page.html
page.html|http|80      => http://example.org/subdir/page.html
page.html|http|8080    => http://example.org:8080/subdir/page.html
page.html|https|       => https://example.org/subdir/page.html
page.html|https|443    => https://example.org/subdir/page.html
page.html||8080        => http://example.org:8080/subdir/page.html
page.html|https|8888   => https://example.org:8888/subdir/page.html
