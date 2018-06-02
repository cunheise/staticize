<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 6:38 PM
 */

namespace Staticize;

use Staticize\Validator\ExistValidator;
use Staticize\Validator\Validator;

/**
 * Class Page
 * @package Staticize
 */
class Page
{
    /**
     * @var string $file
     */
    private $file;
    /**
     * @var array $validators
     */
    private $validators = [];
    /**
     * @var integer $mtime
     */
    private $mtime;
    /**
     * @var OutputBuffer $outputBuffer
     */
    private $outputBuffer;

    /**
     * Page constructor.
     * @param string $file
     */
    public function __construct($file, $mtime = null)
    {
        if (!file_exists($dir = dirname($file))) {
            mkdir($dir, 0777, 1);
        }
        $this->file = $file;
        $this->mtime = $mtime;
        $this->addValidator(new ExistValidator($this));
        $this->outputBuffer = new OutputBuffer();
    }

    /**
     * @param integer $mtime
     * @return $this|Page
     */
    public function setMtime($mtime)
    {
        $this->mtime = $mtime;
        return $this;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param Validator $validator
     * @return Page
     * add validator
     */
    public function addValidator(Validator $validator)
    {
        $className = get_class($validator);
        if (!isset($this->validators[$className])) {
            $validator->setPage($this);
            $this->validators[$className] = $validator;
        }
        return $this;
    }

    /**
     * @return boolean
     * check if page need to staticize
     */
    public function isValid()
    {
        foreach ($this->validators as $validator) {
            if (!$validator->isValid()) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->outputBuffer->getContent() ? $this->outputBuffer->getContent() : file_get_contents($this->file);
    }

    /**
     * @param callable $function
     */
    public function enclose(callable $function)
    {
        $this->outputBuffer->enclose($function);
        file_put_contents($this->file, $this->outputBuffer->getContent());
        if ($this->mtime) {
            touch($this->getFile(), $this->mtime);
        }
    }

    /**
     *
     */
    public function start()
    {
        $this->outputBuffer->start();
    }

    /**
     *
     */
    public function end()
    {
        $this->outputBuffer->end();
        file_put_contents($this->file, $this->outputBuffer->getContent());
        if ($this->mtime) {
            touch($this->getFile(), $this->mtime);
        }
    }
}