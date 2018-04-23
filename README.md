# pheanstalk-debug
Debug for beanstalk

# How to use
 * Type hinting: Pheanstalk -> PheanstalkInterface
 * Configure your factory for pheanstalk
 
 ```
<?php

namespace AppBundle\Pheanstalk;

use Pheanstalk\Pheanstalk;
use razielsd\beanstalklogger\DefaultDebugger;
use razielsd\beanstalklogger\BeanstalkWrapper;


class BeanstalkFactory
{
    public static function factory(string $host, int $port, bool $enableLog)
    {
        $pheanstalk = new Pheanstalk($host, $port,1.0, true);
        $debugger = new DefaultDebugger();
        $debugger->enable($enableLog);
        return new BeanstalkWrapper($pheanstalk, $debugger);
    }
}
```

# Symfony service example

```
    app.pheanstalk:
        class: razielsd\beanstalklogger\BeanstalkWrapper
        factory: ['AppBundle\Beanstalk\BeanstalkFactory', factory]
        arguments: ['%beanstalkd_host%', '%beanstalkd_port%', true]

```
