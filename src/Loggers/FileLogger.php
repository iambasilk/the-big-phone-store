<?php

namespace src\Loggers;

class FileLogger implements Logger
{
    private $logFilePath;

    public function __construct($logFilePath)
    {
        $this->logFilePath = $logFilePath;
    }

    public function log($message)
    {
        $logMessage = sprintf("[%s] %s\n", date('Y-m-d H:i:s'), $message);
        file_put_contents($this->logFilePath, $logMessage, FILE_APPEND);
    }
}
