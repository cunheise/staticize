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
 */
class ModificationValidator extends Validator
{
    /**
     * @var integer $filemtime
     */
    private $filemtime;

    /**
     * ModifyTimeValidator constructor.
     * @param Page $page
     * @param integer $filemtime
     */
    public function __construct($filemtime)
    {
        $this->filemtime = $filemtime;
    }

    /**
     * @return boolean
     */
    public function valid()
    {
        return $this->filemtime == filemtime($this->getPage()->getFile());
    }
}