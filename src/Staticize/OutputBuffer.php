<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/2/2018
 * Time: 8:50 PM
 */

namespace Staticize;

/**
 * Class OutputBuffer
 * @package Staticize
 */
class OutputBuffer
{
    /**
     * @var string $content
     */
    private $content;

    /**
     *
     */
    public function start()
    {
        ob_start();
    }

    /**
     *
     */
    public function end()
    {
        $this->content = ob_get_clean();
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param callable $function
     */
    public function enclose(callable $function)
    {
        ob_start();
        $function();
        $this->content = ob_get_clean();
    }
}