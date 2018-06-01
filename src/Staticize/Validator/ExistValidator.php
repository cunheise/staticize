<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 7:57 PM
 */

namespace Staticize\Validator;

/**
 * Class FileExistValidator
 * @package Staticize\Validator
 * check if generated page exist
 */
class ExistValidator extends Validator
{
    /**
     * @return boolean
     */
    public function valid()
    {
        return file_exists($this->getPage()->getFile());
    }

}