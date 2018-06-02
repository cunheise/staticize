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
$file1 = __DIR__ . '/output/file1.html';
$file2 = __DIR__ . '/output/file2.html';
$page = new Page($file1, $time);
$page->addValidator(new ModificationValidator($time));
if (!$page->isValid()) {
    $a = 'this is test' . PHP_EOL;
    $b = 'test line 2' . PHP_EOL;
    $page->enclose(function () use ($a, $b) {
        echo $a;
        echo $b;
    });
}
echo $page->getContent();

$page = new Page($file2);
if (!$page->isValid()) {
    $page->start();
    echo 'haha' . PHP_EOL;
    $page->end();
}
echo $page->getContent();