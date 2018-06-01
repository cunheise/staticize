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
 * Class ModifyTimeValidator
 * @package Staticize\Validator
 *
 */
class ModifyTimeValidator implements Validator
{
    /**
     * @var Page $page
     */
    private $page;
    /**
     * @var integer $modifyTime
     */
    private $modifyTime;

    /**
     * ModifyTimeValidator constructor.
     * @param Page $page
     * @param integer $modifyTime
     */
    public function __construct(Page $page, $modifyTime)
    {
        $this->page = $page;
        $this->modifyTime = $modifyTime;
    }

    /**
     * @return boolean
     */
    public function valid()
    {
        return $this->modifyTime == filemtime($this->page->getFile());
    }
}