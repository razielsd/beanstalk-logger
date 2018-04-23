# beanstalk-logger
Debug for beanstalk

# How to use
 * Type hinting: Pheanstalk -> PheanstalkInterface
 * Configure your factory for pheanstalk
 
 ```
<?php

namespace AppBundle\Pheanstalk;

use Pheanstalk\Pheanstalk;
use razielsd\beanstalklogger\DefaultLogger;
use razielsd\beanstalklogger\BeanstalkWrapper;


class BeanstalkFactory
{
    public static function factory(string $host, int $port, bool $enableLog)
    {
        $pheanstalk = new Pheanstalk($host, $port, 1.0, true);
        $logger = new DefaultLogger();
        $logger->enable($enableLog);
        return new PheanstalkWrapper($pheanstalk, $logger);
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
