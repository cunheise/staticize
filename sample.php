<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/3/2018
 * Time: 10:11 PM
 */

use Staticize\Page;
use Symfony\Component\Cache\Simple\FilesystemCache;

require __DIR__ . '/vendor/autoload.php';

function makePage($pagename)
{
    return new Page($pagename, new FilesystemCache('', 1, __DIR__ . '/runtime'));
}

$pagename = 'show2-123.html';
$page = makePage($pagename);
$page->enclose(function () {
    echo 'this is enclose test';
    echo 'test';
});
echo $page->getContent();

$pagename = 'show2-124.html';
$page = makePage($pagename);
$page->start();
echo 'this is page2 test';
$page->end();
echo $page->getContent();