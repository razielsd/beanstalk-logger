# pheanstalk-debug
Debug for pheanstalk

#How to use
 * Type hinting: Pheanstalk -> PheanstalkInterface
 * Configure your instance of pheanstalk
 
 ```
class PheanstalkInstance extends PheanstalkDebug
{
    public function __construct($host, $port, $connectTimeout, $connectPersistent)
    {
        $pheanstalk = new Pheanstalk($host, $port, $connectTimeout, $connectPersistent);
        $debugger = new DefaultDebugger();
        $this->init($pheanstalk, $debugger);
    }
}
```