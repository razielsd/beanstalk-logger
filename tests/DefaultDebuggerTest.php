<?php

require_once (__DIR__ . '/../vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use razielsd\beanstalklogger\DefaultDebugger;


class DefaultDebuggerTest extends TestCase
{

    protected $filename = '/tmp/debugger-test.log';

    public function testInt()
    {
        $debugger = $this->getDebugger();
        $debugger->log('put', [1, 2, 3, 4]);

        $this->assertEquals('Beanstalk: put, params: [1, 2, 3, 4]', trim($this->getLog()));
    }



    public function testFloat()
    {
        $debugger = $this->getDebugger();
        $debugger->log('put', [1.1, 2.2, 3.3, 4.4]);

        $this->assertEquals('Beanstalk: put, params: [1.1, 2.2, 3.3, 4.4]', trim($this->getLog()));
    }



    public function testBool()
    {
        $debugger = $this->getDebugger();
        $debugger->log('putInTube', [true, false]);

        $this->assertEquals('Beanstalk: putInTube, params: [TRUE, FALSE]', trim($this->getLog()));
    }


    public function testNull()
    {
        $debugger = $this->getDebugger();
        $debugger->log('put', [null]);

        $this->assertEquals('Beanstalk: put, params: [NULL]', trim($this->getLog()));
    }


    public function testObject()
    {
        $debugger = $this->getDebugger();
        $debugger->log('put', [$debugger]);

        $this->assertEquals(
            'Beanstalk: put, params: [object(razielsd\beanstalklogger\DefaultDebugger)]',
            trim($this->getLog())
        );
    }


    public function testEmptyParam()
    {
        $debugger = $this->getDebugger();
        $debugger->log('put', []);

        $this->assertEquals('Beanstalk: put, params: []', trim($this->getLog()));
    }


    public function testLongString()
    {
        $debugger = $this->getDebugger();
        $debugger->log('watch', [str_repeat('tubeName ', 100)]);

        $this->assertEquals(
            'Beanstalk: watch, params: ["tubeName tubeName tubeName tubeName tubeName tu..."]',
            trim($this->getLog())
        );
    }



    protected function getDebugger(): DefaultDebugger
    {
        $this->filename = '/tmp/ph-debug-' . date('YmdTHis') . '.' . mt_rand(10000, 99999) . '.log';
        $debugger = new DefaultDebugger();
        $debugger->setFilename($this->filename);
        return $debugger;
    }


    protected function getLog()
    {
        if (!file_exists($this->filename)) {
            return null;
        }
        return file_get_contents($this->filename);
    }


    public function tearDown()
    {
        if (file_exists($this->filename)) {
            unlink($this->filename);
        }
        parent::tearDown();
    }
}