<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 2018/6/4
 * Time: 9:26
 */

require dirname(__DIR__) . '/vendor/autoload.php';


use Pimple\Container;
use Staticize\Page;
use Symfony\Component\Cache\Simple\FilesystemCache;

$container = new Container();
$container['namespace'] = 'namespace';
$container['lifetime'] = 1;
$container['directory'] = dirname(__DIR__) . '/runtime';
$container['cache'] = function ($c) {
    return new FilesystemCache($c['namespace'], $c['lifetime'], $c['directory']);
};
$container['page'] = function ($c) {
    return new Page($c['pagename'], $c['cache']);
};