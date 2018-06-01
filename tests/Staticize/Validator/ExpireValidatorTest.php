<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 11:54 PM
 */

namespace Tests\Staticize\Validator;

use Staticize\Page;
use Staticize\Validator\ExpireValidator;

class ExpireValidatorTest extends \PHPUnit_Framework_TestCase
{

    public function testFalseValid()
    {
        $file = __DIR__ . '/test.html';
        $page = new Page($file);
        $page->addValidator(new ExpireValidator(1));
        $page->staticize(function () {
            echo '1';
        });
        sleep(2);
        $this->assertFalse($page->valid());
        unlink($file);
    }

    public function testTrueValid()
    {
        $file = __DIR__ . '/test.html';
        $page = new Page($file);
        $page->addValidator(new ExpireValidator());
        $page->staticize(function () {
            echo '1';
        });
        $this->assertTrue($page->valid());
        unlink($file);
    }
}
