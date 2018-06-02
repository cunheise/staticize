<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 11:54 PM
 */

namespace Tests\Staticize\Validator;

use Staticize\Validator\ExistValidator;

class ExistValidatorTest extends BaseValidatorTest
{

    public function testFalseValid()
    {
        $this->page->addValidator(new ExistValidator());
        $this->assertFalse($this->page->isValid());
    }

    /**
     * @depends testFalseValid
     */
    public function testTrueValid()
    {
        $this->page->enclose(function () {
            echo '1';
        });
        $this->assertTrue($this->page->isValid());
        unlink($this->file);
    }

}
