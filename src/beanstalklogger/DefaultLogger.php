<?php

namespace razielsd\beanstalklogger;


class DefaultLogger implements DebugInterface
{
    const STRING_MAX_LENGTH = 50;


    protected $filename = '/tmp/pheanstalk.log';
    protected $isEnabled = true;


    public function setFilename(string $filename)
    {
        $this->filename = $filename;
        return $this;
    }


    public function enable(bool $isEnabled = true)
    {
        $this->isEnabled = $isEnabled;
        return $this;
    }


    public function log(string $method, array $params)
    {
        $paramList = [];
        foreach ($params as $value) {
            if (!is_object($value)) {
                $type = gettype($value);
                switch ($type) {
                    case 'integer':
                    case 'float':
                    case 'double':
                        $paramTxt = $value;
                        break;
                    case 'boolean':
                        $paramTxt = $value ? 'TRUE' : 'FALSE';
                        break;
                    case 'NULL':
                        $paramTxt = 'NULL';
                        break;
                    case 'resource':
                        $paramTxt = '#resource';
                        break;
                    default:
                        $paramTxt = '"' . $value . '"';
                        if (mb_strlen($value) > self::STRING_MAX_LENGTH) {
                            $paramTxt = mb_substr($value, 0, self::STRING_MAX_LENGTH - 3) . '...';
                            $paramTxt = '"' . $paramTxt . '"';
                        }
                        break;

                }
                $paramList[] = $paramTxt;
            } else {
                $paramList[] = 'object(' . get_class($value) . ')';
            }
        }
        $message =  "Beanstalk: {$method}";
        $message .= ', params: [' . join(', ', $paramList) . ']';
        $this->write($message);
    }


    protected function write(string $message)
    {
        if ($this->isEnabled) {
            file_put_contents($this->filename, $message . "\n", FILE_APPEND);
        }
    }
}