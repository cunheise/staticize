<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 7:57 PM
 */

namespace Staticize\Validator;

use Staticize\ModifyPage;

/**
 * Class ModifyTimeValidator
 * @package Staticize\Validator
 *
 */
class ModifyTimeValidator implements Validator
{
    /**
     * @var ModifyPage $page
     */
    private $page;
    /**
     * @var integer $modifyTime
     */
    private $modifyTime;

    /**
     * ModifyTimeValidator constructor.
     * @param ModifyPage $page
     * @param integer $modifyTime
     */
    public function __construct(ModifyPage $page, $modifyTime)
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