--TEST--
absoluteURI() URL: http://example.org/subdir/test.php/?abc=123
--ENV--
HTTP_HOST=example.org
SERVER_NAME=example.org
QUERY_STRING=abc=123
SERVER_PORT=80
PATH_INFO=/
REQUEST_URI=/subdir/test.php/?abc=123
SCRIPT_NAME=/subdir/test.php
--FILE--
<?php
/**
 * This test checks that absoluteURI() still works with PATH_INFO being
 * just a / and QUERY_STRING passed to the script.
 *
 * Relative URLs are resolved to the current script, stripping PATH_INFO
 *
 * PHP version 5
 *
 * @category HTTP
 * @package  HTTP2
 * @author   Philippe Jausions <jausions@php.net>
 * @license  http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @link     http://pear.php.net/package/HTTP2
 */
require __DIR__ . '/absoluteURI.inc';

?>
--EXPECT--
||                   => http://example.org/subdir/test.php/?abc=123
?new=value||         => http://example.org/subdir/test.php/?new=value
#anchor||            => http://example.org/subdir/test.php/?abc=123#anchor
/page.html||         => http://example.org/page.html
page.html||          => http://example.org/subdir/page.html
page.html|http|      => http://example.org/subdir/page.html
page.html|http|80    => http://example.org/subdir/page.html
page.html|http|8080  => http://example.org:8080/subdir/page.html
page.html|https|     => https://example.org/subdir/page.html
page.html|https|443  => https://example.org/subdir/page.html
page.html||8080      => http://example.org:8080/subdir/page.html
page.html|https|8888 => https://example.org:8888/subdir/page.html
