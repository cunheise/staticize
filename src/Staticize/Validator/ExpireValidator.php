<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 8:17 PM
 */

namespace Staticize\Validator;

use Staticize\Page;

/**
 * Class ExpireValidator
 * @package Staticize\Validator
 * check if generated page modify time expired
 */
class ExpireValidator implements Validator
{
    /**
     * @var Page $page
     */
    private $page;
    /**
     * @var integer $delta
     */
    private $delta;

    /**
     * ExpireValidator constructor.
     * @param Page $page
     * @param integer $delta
     * default 1 hour
     */
    public function __construct(Page $page, $delta = 3600)
    {
        $this->page = $page;
        $this->delta = $delta;
    }

    /**
     * @return boolean
     */
    public function valid()
    {
        return time() - filemtime($this->page->getFile()) <= $this->delta;
    }
}