<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 7:09 PM
 */

use Staticize\Page;
use Staticize\Validator\ModificationValidator;

require __DIR__ . '/vendor/autoload.php';
$time = time();
$page = new Page(__DIR__ . '/test/test.html', $time);
$page->addValidator(new ModificationValidator($time));
if (!$page->valid()) {
    $a = 'this is test' . PHP_EOL;
    $b = 'test 2 h';
    $page->staticize(function () use ($a, $b) {
        echo $a;
        echo $b;
    });
}
echo $page->getContent();