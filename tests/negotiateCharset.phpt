--TEST--
negotiateCharset() with default
--ENV--
HTTP_HOST=example.org
SERVER_NAME=example.org
QUERY_STRING=
SERVER_PORT=80
HTTPS=off
REQUEST_URI=/subdir/test.php
SCRIPT_NAME=/subdir/test.php
HTTP_ACCEPT_CHARSET=ISO-8859-1, Big5;q=0.6,utf-8;q=0.7, *;q=0.5
--FILE--
<?php
/**
 * This test checks for charset negotiation
 *
 * PHP version 5
 *
 * @category HTTP
 * @package  HTTP2
 * @author   Philippe Jausions <jausions@php.net>
 * @license  http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @link     http://pear.php.net/package/HTTP2
 */
require_once  'HTTP2.php';

// The --ENV-- Accept sets the following order
// (preferred charsets first)
// 1. ISO-8859-1 (Latin1 - Western Europe)
// 2. UTF-8
// 3. Big5 (Traditional Chinese)
// 3. * (any other)

$sets = array(
    1 => array(
        'utf-8',
        'big5',
        'iso-8859-1',
        'shift-jis',
    ),
    2 => array(
        'utf-8',
        'big5',
        'shift-jis',
    ),
    3 => array(
        'Big5',
        'shift-jis',
    ),
    4 => array(
        'shift-jis',
    ),
    5 => array(
    ),
);

$http = new HTTP2();
foreach ($sets as $i => $supported) {
    echo $i.' => '. $http->negotiateCharset($supported, 'us-ascii')
         ."\n";
}

?>
--EXPECT--
1 => iso-8859-1
2 => utf-8
3 => Big5
4 => shift-jis
5 => us-ascii
