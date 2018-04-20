<?php

namespace razielsd\pheanstalkdebug;


interface DebugInterface
{
    public function log(string $method, array $params);
}