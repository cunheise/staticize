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
     * @var integer $expireAfter
     */
    private $expireAfter;

    /**
     * ExpireValidator constructor.
     * @param integer $expireAfter
     * default 1 hour
     */
    public function __construct($expireAfter = 3600)
    {
        $this->expireAfter = $expireAfter;
    }

    /**
     * @return boolean
     */
    public function isValid()
    {
        return time() - filemtime($this->getPage()->getFile()) <= $this->expireAfter;
    }
}