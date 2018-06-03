<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/3/2018
 * Time: 9:17 PM
 */

namespace Staticize;


class OutputBuffer
{
    /**
     * @var string $content
     */
    private $content;

    /**
     * start outputbuffer
     */
    public function start()
    {
        ob_start();
    }

    /**
     * end outputbuffer
     */
    public function end()
    {
        $this->content = ob_get_clean();
    }

    /**
     * @param callable $callable
     * enclose block of code
     */
    public function enclose(callable $callable)
    {
        ob_start();
        $callable();
        $this->content = ob_get_clean();
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

}