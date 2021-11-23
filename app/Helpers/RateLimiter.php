<?php

namespace App\Helpers;

class RateLimiter{
    private $frequency = 0;
    private $duration = 0;
    private $instances = [];

    public function __construct(int $frequency, int $duration = 1){
        $this->frequency = $frequency;
        $this->duration = $duration;
    }

    public function await(){
        $this->purge();
        $this->instances[] = microtime(true);

        if (!$this->isFree()) {
            $wait_duration = $this->durationUntilFree();
            usleep($wait_duration);
        }
    }

    public function setFrequency(int $frequency){
        $this->frequency = $frequency;
    }

    //Remove expired instances
    private function purge(){
        $cutoff = microtime(true) - $this->duration;

        $this->instances = array_filter($this->instances, function ($a) use ($cutoff) {
            return $a >= $cutoff;
        });
        //----------
        $this->instances = array_values($this->instances);
    }

    private function isFree(){
        return count($this->instances) < $this->frequency;
    }

    /**
     * Get the number of microseconds until we can run the next instance
     *
     * @return float
     */
    private function durationUntilFree(){
        $oldest = $this->instances[0];
        $free_at = $oldest + $this->duration * 1000000;
        $now = microtime(true);

        return ($free_at < $now) ? 0 : $free_at - $now;
    }

}