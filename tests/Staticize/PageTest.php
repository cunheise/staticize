<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 11:51 PM
 */

namespace Tests\Staticize;


use Staticize\Page;

class PageTest extends \PHPUnit_Framework_TestCase
{

    public function testGetContent()
    {
        $file = __DIR__ . '/test.html';
        $page = new Page($file);
        $a = 'this is test';
        $page->staticize(function () use ($a) {
            echo $a . PHP_EOL;
            echo 'test2';
        });
        $this->assertEquals('this is test' . PHP_EOL . 'test2', $page->getContent());
        unlink($file);
    }

}
