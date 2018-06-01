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
     * @var integer $filemtime
     */
    private $filemtime;

    /**
     * ModifyTimeValidator constructor.
     * @param integer $filemtime
     */
    public function __construct($filemtime)
    {
        $this->filemtime = $filemtime;
    }

    /**
     * @return boolean
     */
    public function isValid()
    {
        return $this->filemtime == filemtime($this->getPage()->getFile());
    }
}