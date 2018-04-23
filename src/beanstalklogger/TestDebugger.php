<?php

namespace razielsd\beanstalklogger;


class TestDebugger implements DebugInterface
{
    protected $stack = [];


    public function log(string $method, array $params)
    {
        $this->stack[] = ['method' => $method, 'params' => $params];
    }


    public function getFullStack(): array
    {
        return $this->stack;
    }


    public function reset()
    {
        $this->stack = [];
        return $this;
    }


    public function getLast(): ?array
    {
        if (empty($this->stack)) {
            return null;
        }
        return $this->stack[count($this->stack) - 1];
    }
}