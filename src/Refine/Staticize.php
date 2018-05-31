<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 2018/5/31
 * Time: 17:56
 */

namespace Refine;


class Staticize
{
    private static $instance;
    private $config;

    private function __construct($config)
    {
        $this->config = $config;
    }

    public static function getInstance($config)
    {
        if (self::$instance == null) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }


    public function start()
    {

    }

    public function end()
    {

    }
}