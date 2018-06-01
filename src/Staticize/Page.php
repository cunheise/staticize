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
     * @var string $content
     */
    private $content;
    /**
     * @var array $validators
     */
    private $validators = [];
    /**
     * @var integer $filemtime
     */
    private $filemtime;

    /**
     * Page constructor.
     * @param string $file
     */
    public function __construct($file, $filemtime = null)
    {
        if (!file_exists($dir = dirname($file))) {
            mkdir($dir, 0777, 1);
        }
        $this->file = $file;
        $this->filemtime = $filemtime;
        $this->addValidator(new ExistValidator($this));
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
        if ($this->content == null) {
            $this->content = file_get_contents($this->file);
        }
        return $this->content;
    }

    /**
     * @param callable $function
     * @return Page $this
     * staticize page
     */
    public function staticize($function)
    {
        ob_start();
        if (is_callable($function)) {
            $function();
        }
        $this->content = ob_get_clean();
        file_put_contents($this->file, $this->content);
        if ($this->filemtime) {
            touch($this->getFile(), $this->filemtime);
        }
        return $this;
    }

    /**
     * @return $this|Page
     * output buffer start
     */
    public function start()
    {
        ob_start();
        return $this;
    }

    /**
     * @return $this|Page
     * get content from output buffer and save it in $this->file and clean it
     */
    public function end()
    {
        $this->content = ob_get_clean();
        file_put_contents($this->file, $this->content);
        if ($this->filemtime) {
            touch($this->getFile(), $this->filemtime);
        }
        return $this;
    }
}