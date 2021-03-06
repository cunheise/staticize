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
        $this->assertFalse($page->isValid());
        $page->enclose(function () {
            echo '1';
        });
        $this->assertTrue($page->isValid());
        $this->assertEquals('1', $page->getContent());
    }

    /**
     * @test
     */
    public function enclose()
    {
        $this->assertFalse($this->page->isValid());
        $this->page->enclose(function () {
            echo '1';
        });
        $this->assertTrue($this->page->isValid());
        $this->assertEquals(1, $this->page->getContent());
    }

    /**
     * @test
     */
    public function start_and_end()
    {
        $this->assertFalse($this->page->isValid());
        $this->page->start();
        echo '1';
        $this->page->end();
        $this->assertTrue($this->page->isValid());
        $this->assertEquals(1, $this->page->getContent());
    }

    protected function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
        $this->page->delete();
    }

}
