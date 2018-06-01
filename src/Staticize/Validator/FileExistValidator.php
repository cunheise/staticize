<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 7:57 PM
 */

namespace Staticize\Validator;

use Staticize\Page;

/**
 * Class FileExistValidator
 * @package Staticize\Validator
 * check if generated page exist
 */
class FileExistValidator implements Validator
{
    /**
     * @var Page $page
     */
    private $page;

    /**
     * FileExistValidator constructor.
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * @return boolean
     */
    public function valid()
    {
        return file_exists($this->page->getFile());
    }

}