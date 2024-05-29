<?php

namespace App\Services;

class QueryTimerService
{
    private $startTime;

    public function start()
    {
        $this->startTime = microtime(true);
    }

    public function getDuration(): float
    {
        if ($this->startTime === null) {
            throw new \Exception("Timer has not been started.");
        }

        return microtime(true) - $this->startTime;
    }

    public function getDurationInSeconds(): string
    {
        $duration = $this->getDuration();
        return number_format($duration, 2) . ' seconds';
    }
}
