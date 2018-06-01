<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 7:09 PM
 */

use Staticize\ModifyPage;
use Staticize\Validator\ModifyTimeValidator;

require __DIR__ . '/vendor/autoload.php';
$time = time();
echo $time . PHP_EOL;
$page = new ModifyPage(__DIR__ . '/output/test.html', $time);
$page->addValidator(new ModifyTimeValidator($page, '1527857125'));
if (!$page->valid()) {
    $a = 'this is test' . PHP_EOL;
    $b = 'test 2 h';
    $page->staticize(function () use ($a, $b) {
        echo $a;
        echo $b;
    });
}
echo $page->getContent();