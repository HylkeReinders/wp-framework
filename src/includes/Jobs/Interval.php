<?php

namespace CoffeePlugins\Framework\Jobs;

abstract class Interval {
    abstract public function getCronName();

    abstract public function getInterval();
    
    abstract public function getDisplayName();
}

class FiveSecondsInterval extends Interval {
    public function getCronName() 
    {
        return 'five_seconds';
    }

    public function getInterval()
    {
        return 5;
    }

    public function getDisplayName()
    {
        return 'Every Five Seconds';
    }
}