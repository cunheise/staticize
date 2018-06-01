<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 11:54 PM
 */

namespace Tests\Staticize\Validator;

use Staticize\Page;
use Staticize\Validator\ModificationValidator;

class ModificationValidatorTest extends \PHPUnit_Framework_TestCase
{

    public function testFalseValid()
    {
        $file = __DIR__ . '/test.html';
        $time = time();
        $page = new Page($file, $time);
        $page->addValidator(new ModificationValidator($time + 100));
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
        $time = time();
        $page = new Page($file, $time);
        $page->addValidator(new ModificationValidator($time));
        $page->staticize(function () {
            echo '1';
        });
        $this->assertTrue($page->valid());
        unlink($file);
    }
}
