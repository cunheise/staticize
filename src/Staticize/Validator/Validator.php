<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 7:59 PM
 */

namespace Staticize\Validator;

/**
 * Interface Validator
 * @package Staticize\Validator
 */
interface Validator
{
    /**
     * @return boolean
     * check if page is valid
     */
    public function valid();
}