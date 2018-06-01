<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 11:54 PM
 */

namespace Tests\Staticize\Validator;

use Staticize\Page;
use Staticize\Validator\ExistValidator;

class ExistValidatorTest extends \PHPUnit_Framework_TestCase
{

    public function testFalseValid()
    {
        $file = __DIR__ . '/test.html';
        $page = new Page($file);
        $page->addValidator(new ExistValidator());
        $this->assertFalse($page->valid());
    }

    public function testTrueValid()
    {
        $file = __DIR__ . '/test.html';
        $page = new Page($file);
        $page->addValidator(new ExistValidator());
        $this->assertFalse($page->valid());
        $page->staticize(function () {
            echo '1';
        });
        $this->assertTrue($page->valid());
        unlink($file);
    }
}
