<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 7:59 PM
 */

namespace Staticize\Validator;

use Staticize\Page;

/**
 * Interface Validator
 * @package Staticize\Validator
 */
abstract class Validator
{
    /**
     * @var Page $page
     */
    private $page;

    /**
     * @return boolean
     * check if page is valid
     */
    abstract public function valid();

    /**
     * @param Page $page
     * @return $this|Validator
     */
    public function setPage(Page $page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return Page
     */
    public function getPage()
    {
        return $this->page;
    }
}