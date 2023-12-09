<?php


namespace CoffeePlugins\Framework\Plugin;

use CoffeePlugins\Framework\Hooks\HooksManager;
use CoffeePlugins\Framework\Jobs\FiveSecondsInterval;
use CoffeePlugins\Framework\Options\WPOptions;

if (!defined('ABSPATH')) {
  exit;
}

abstract class Plugin
{

  const PREFIX = 'coffee_plugins_bol_connector';

  abstract static function prefix();
  /**
   * @var HooksManager An instance of the `HooksManager` class.
   */
  public $hooksManager;

  public $options;

  public $bigBuyApi;

  public $cronJobs;

  /**
   * Plugin constructor.
   */
  public function __construct()
  {
    $this->setupConstants();
    
    add_action('plugins_loaded', array($this, 'init'));
    
    $this->collectIntervals();
    register_deactivation_hook( __FILE__, [$this, 'privateDeactivation']
    );
  }

  public function privateDeactivation()
  {

    foreach ($this->cronJobs as $job) {
      $job->cancelEvent();
    }

    $this->deactivation();
  }


  /**
   * Setup constants.
   */
  private function setupConstants()
  {
    if (!defined(__NAMESPACE__ . '\PLUGIN_URL')) {
      define(__NAMESPACE__ . '\PLUGIN_URL', plugin_dir_url(__FILE__));
    }

    if (!defined(__NAMESPACE__ . '\VERSION')) {
      define(__NAMESPACE__ . '\VERSION', '1.0.0');
    }
  }

  /**
   * Initialize the plugin once activated plugins have been loaded.
   */
  public function init()
  {
    $this->hooksManager = new HooksManager();
    $this->options = new WPOptions($this->defaultOptions());


    $this->collectPages($this->options, $this->hooksManager);
    $this->cronJobs = $this->cronJobs();

    $this->initialization();
  }


  public function collectPages($options, $hooks_manager)
  {
    $pages = [
      // new Settings_Page($options, $hooks_manager)
    ];

    foreach (array_merge($pages, $pages) as $page) {
      $this->hooksManager->register($page);
    }
  }

  private function collectIntervals(): void 
  {
    $privateIntervals = [
        new FiveSecondsInterval()
    ];

    
    foreach (array_merge($privateIntervals, $this->intervals()) as $interval) {
        add_filter('cron_schedules', function ($schedules) use ($interval) {
          $schedules[$interval->getCronName()] = array(
            'interval' => $interval->getInterval(),
            'display'  => esc_html__($interval->getDisplayName()),
          );
          return $schedules;
        });
    }
  }

  abstract public function intervals(): array;
  
  abstract public function pages(): array;

  abstract public function cronJobs(): array;

  abstract public function defaultOptions(): array;

  abstract public function initialization();
  abstract public function deactivation();

}
