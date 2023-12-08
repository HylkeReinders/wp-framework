<?php

namespace CoffeePlugins\BolWpPlugin\Jobs;

use CoffeePlugins\BolWpPlugin\Hooks\Actions;

class InsertBigBuyInitialData extends CronJob {
    public function name() {
        return 'InsertBigBuyInitialData';
    }
    
    public function interval() {
        return 'five_seconds';
    }
    
    public function updateEvents() {
        error_log('bla');
        echo 'f you';
    }

}