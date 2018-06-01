<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/1/2018
 * Time: 6:38 PM
 */

namespace Staticize;

use Staticize\Validator\FileExistValidator;
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
     * Page constructor.
     * @param string $file
     */
    public function __construct($file)
    {
        $this->file = $file;
        $this->addValidator(new FileExistValidator($this));
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
            $this->validators[$className] = $validator;
        }
        return $this;
    }

    /**
     * @return boolean
     * check if page need to staticize
     */
    public function valid()
    {
        foreach ($this->validators as $validator) {
            if (!$validator->valid()) {
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
        return $this;
    }

}