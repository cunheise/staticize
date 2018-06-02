<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/2/2018
 * Time: 9:42 PM
 */

namespace Tests\Staticize\Validator;


use Staticize\Page;

abstract class BaseValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string $file
     */
    protected $file;
    /**
     * @var Page $page
     */
    protected $page;

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->file = __DIR__ . '/test.html';
        $this->page = new Page($this->file);
    }
}