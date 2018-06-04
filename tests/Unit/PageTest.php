<?php
/**
 * Created by PhpStorm.
 * User: nathan
 * Date: 6/3/2018
 * Time: 10:54 PM
 */

namespace Tests\Unit\Staticize;

use Staticize\Page;
use Symfony\Component\Cache\Simple\FilesystemCache;

class PageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Page $page
     */
    private $page;

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->page = new Page('test.html', new FilesystemCache('', 1, dirname(dirname(__DIR__)) . '/runtime'));
    }

    /**
     * @test
     */
    public function pagename()
    {
        $page = new Page('http://www.baidu.com', new FilesystemCache('', 1, dirname(dirname(__DIR__)) . '/runtime'));
        $this->assertEquals('', $page->getContent());
        $page->enclose(function () {
            echo '1';
        });
        $this->assertEquals('1', $page->getContent());
    }

    /**
     * @test
     */
    public function enclose()
    {
        $this->assertEquals('', $this->page->getContent());
        $this->page->enclose(function () {
            echo '1';
        });
        $this->assertEquals(1, $this->page->getContent());
    }

    /**
     * @test
     */
    public function start_and_end()
    {
        $this->assertEquals('', $this->page->getContent());
        $this->page->start();
        echo '1';
        $this->page->end();
        $this->assertEquals(1, $this->page->getContent());
    }

    protected function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
        $this->page->delete();
    }

}
