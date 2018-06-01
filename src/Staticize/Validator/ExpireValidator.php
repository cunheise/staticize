<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 8:17 PM
 */

namespace Staticize\Validator;

/**
 * Class ExpireValidator
 * @package Staticize\Validator
 * check if generated page modify time expired
 */
class ExpireValidator extends Validator
{
    /**
     * @var integer $delta
     */
    private $delta;

    /**
     * ExpireValidator constructor.
     * @param integer $delta
     * default 1 hour
     */
    public function __construct($delta = 3600)
    {
        $this->delta = $delta;
    }

    /**
     * @return boolean
     */
    public function valid()
    {
        return time() - filemtime($this->getPage()->getFile()) <= $this->delta;
    }
}