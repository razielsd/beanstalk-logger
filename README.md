# pheanstalk-debug
Debug for pheanstalk

#How to use
 * Type hinting: Pheanstalk -> PheanstalkInterface
 * Configure your factory for pheanstalk
 
 ```
<?php

namespace AppBundle\Pheanstalk;

use Pheanstalk\Pheanstalk;
use razielsd\pheanstalkdebug\DefaultDebugger;
use razielsd\pheanstalkdebug\PheanstalkWrapper;


class PheanstalkFactory
{
    public static function factory(string $host, int $port, bool $enableLog)
    {
        $pheanstalk = new Pheanstalk($host, $port,1.0, true);
        $debugger = new DefaultDebugger();
        $debugger->enable($enableLog);
        return new PheanstalkWrapper($pheanstalk, $debugger);
    }
}
```

