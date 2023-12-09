<?php

namespace CoffeePlugins\Framework\Jobs;


abstract class CronJob
{

    /**
     * Name of the CronJob that needs to run.
     * 
     * @return string
     */
    abstract public function name();
    
    /**
     * Interval of the CronJob. 
     * Possible entries
     * 
     * - five_seconds
     * - hourly
     * - daily
     * - twicedaily
     * 
     * @return string
     */
    abstract public function interval();
    
    /**
     * Callback function of the CronJob that needs to run.
     * 
     * @return void
     */
    abstract public function updateEvents();

    public function cancelEvent() 
    {
        $timestamp = wp_next_scheduled( $this->name() );
        wp_unschedule_event( $timestamp, $this->name() );
    }

    public function __construct()
    {
        if (wp_next_scheduled($this->name()) == false) {
            wp_schedule_event(time(), $this->interval(), $this->name());
        }

        add_action($this->name(),  [$this, 'updateEvents']);
    }
}
