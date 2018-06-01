<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 8:38 PM
 */

namespace Staticize;

/**
 * Class ModifyPage
 * @package Staticize
 */
class ModifyPage extends Page
{
    /**
     * @var integer $modifyTime
     */
    private $modifyTime;

    /**
     * ModifyPage constructor.
     * @param string $file
     * @param integer $modifyTime
     */
    public function __construct($file, $modifyTime)
    {
        parent::__construct($file);
        $this->modifyTime = $this->modifyTime;
    }

    /**
     * @param callable $function
     * @return $this|Page
     */
    public function staticize($function)
    {
        parent::staticize($function);
        touch($this->getFile(), $this->modifyTime);
        return $this;
    }

}