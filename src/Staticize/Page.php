<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/3/2018
 * Time: 9:36 PM
 */

namespace Staticize;

use Symfony\Component\Cache\Simple\AbstractCache;
use Symfony\Component\Cache\Simple\FilesystemCache;

/**
 * Class Page
 * @package Staticize
 */
class Page
{
    /**
     * @var OutputBuffer $outputBuffer
     */
    private $outputBuffer;
    /**
     * @var AbstractCache $cache
     */
    private $cache;
    /**
     * @var string $pagename
     */
    private $pagename;

    /**
     * Page constructor.
     * @param string $pagename
     * @param AbstractCache|null $cache
     */
    public function __construct($pagename, AbstractCache $cache = null)
    {
        $this->outputBuffer = new OutputBuffer();
        if ($cache == null) {
            $cache = new FilesystemCache();
        }
        $this->cache = $cache;
        $this->pagename = $pagename;
    }

    /**
     * @param callable $callable
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function enclose(callable $callable)
    {
        if (!$this->cache->has($this->pagename)) {
            $this->outputBuffer->enclose($callable);
            $this->cache->set($this->pagename, $this->outputBuffer->getContent());
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
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function end()
    {
        if (!$this->cache->has($this->pagename)) {
            $this->outputBuffer->end();
            $this->cache->set($this->pagename, $this->outputBuffer->getContent());
        }
    }

    /**
     * @return mixed|null|string
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getContent()
    {
        return ($content = $this->outputBuffer->getContent()) ? $content : $this->cache->get($this->pagename);
    }

    /**
     * @return mixed|null|string
     */
    public function __toString()
    {
        return $this->getContent();
    }

    public function delete()
    {
        $this->cache->delete($this->pagename);
    }

}