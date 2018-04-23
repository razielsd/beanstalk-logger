<?php

namespace razielsd\beanstalklogger;


interface DebugInterface
{
    public function log(string $method, array $params);
}