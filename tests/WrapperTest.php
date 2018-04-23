<?php

require_once (__DIR__ . '/../vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use Pheanstalk\Pheanstalk;
use razielsd\pheanstalkdebug\PheanstalkWrapper;
use razielsd\pheanstalkdebug\TestDebugger;


class WrapperTest extends TestCase
{
    protected $host = '127.0.0.1';
    protected $port = 11300;
    /** @var TestDebugger */
    protected $debugger = null;
    protected $tubeName = 'test';


    public function testPut()
    {
        $client = $this->createWrapper();
        $client->useTube($this->tubeName)->put('test:data');
        $req = $this->debugger->getLast();
        $this->assertNotNull($req, 'No command found');
        $this->assertEquals('put', $req['method']);
    }


    public function testPutInTube()
    {
        $client = $this->createWrapper();
        $client->putInTube($this->tubeName, 'test:data');
        $req = $this->debugger->getLast();
        $this->assertNotNull($req, 'No command found');
        $this->assertEquals('putInTube', $req['method']);
    }


    public function testUseTube()
    {
        $client = $this->createWrapper();
        $client->useTube($this->tubeName);
        $req = $this->debugger->getLast();
        $this->assertNotNull($req, 'No command found');
        $this->assertEquals('useTube', $req['method']);
    }


    public function testWatch()
    {
        $client = $this->createWrapper();
        $client->watch($this->tubeName);
        $req = $this->debugger->getLast();
        $this->assertNotNull($req, 'No command found');
        $this->assertEquals('watch', $req['method']);
    }


    public function testWatchOnly()
    {
        $client = $this->createWrapper();
        $client->watchOnly($this->tubeName);
        $req = $this->debugger->getLast();
        $this->assertNotNull($req, 'No command found');
        $this->assertEquals('watchOnly', $req['method']);
    }


    protected function createWrapper(): PheanstalkWrapper
    {
        $pheanstalk = new Pheanstalk($this->host, $this->port);
        $this->debugger = new TestDebugger();
        $wrapper = new PheanstalkWrapper($pheanstalk, $this->debugger);
        return $wrapper;
    }
}