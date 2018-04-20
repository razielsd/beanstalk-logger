<?php

require_once (__DIR__ . '/../vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use Pheanstalk\Pheanstalk;
use razielsd\pheanstalkdebug\PheanstalkDebug;
use razielsd\pheanstalkdebug\TestDebugger;


class DebugTest extends TestCase
{
    protected $host = '127.0.0.1';
    protected $port = 11300;
    /** @var TestDebugger */
    protected $debugger = null;
    protected $tubeName = 'test';


    public function testPut()
    {
        $client = $this->getClient();
        $client->useTube($this->tubeName)->put('test:data');
        $req = $this->debugger->getLast();
        $this->assertNotNull($req, 'No command found');
        $this->assertEquals('put', $req['method']);
    }


    public function testPutInTube()
    {
        $client = $this->getClient();
        $client->putInTube($this->tubeName, 'test:data');
        $req = $this->debugger->getLast();
        $this->assertNotNull($req, 'No command found');
        $this->assertEquals('putInTube', $req['method']);
    }


    public function testUseTube()
    {
        $client = $this->getClient();
        $client->useTube($this->tubeName);
        $req = $this->debugger->getLast();
        $this->assertNotNull($req, 'No command found');
        $this->assertEquals('useTube', $req['method']);
    }


    public function testWatch()
    {
        $client = $this->getClient();
        $client->watch($this->tubeName);
        $req = $this->debugger->getLast();
        $this->assertNotNull($req, 'No command found');
        $this->assertEquals('watch', $req['method']);
    }


    public function testWatchOnly()
    {
        $client = $this->getClient();
        $client->watchOnly($this->tubeName);
        $req = $this->debugger->getLast();
        $this->assertNotNull($req, 'No command found');
        $this->assertEquals('watchOnly', $req['method']);
    }


    protected function getClient(): PheanstalkDebug
    {
        $pheanstalk = new Pheanstalk($this->host, $this->port);
        $this->debugger = new TestDebugger();
        $client = new PheanstalkDebug($pheanstalk, $this->debugger);
        return $client;
    }
}