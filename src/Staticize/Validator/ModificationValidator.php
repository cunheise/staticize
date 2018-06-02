<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 7:57 PM
 */

namespace Staticize\Validator;

/**
 * Class ModifyTimeValidator
 * @package Staticize\Validator
 */
class ModificationValidator extends Validator
{
    /**
     * @var integer $mtime
     */
    private $mtime;

    /**
     * ModifyTimeValidator constructor.
     * @param integer $mtime
     */
    public function __construct($mtime)
    {
        $this->mtime = $mtime;
    }

    /**
     * @return boolean
     */
    public function isValid()
    {
        return $this->mtime == filemtime($this->getPage()->getFile());
    }
}