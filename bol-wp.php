<?php

/**
 * Plugin Name: CoffeePlugins Bol.com Connector.
 * description: Connect your Bol.com Store to WooCommerce
 * Version: 1.0.0
 * Author: CoffeePlugins
 * Author URI: https://coffeeplugins.com
 * Text Domain: coffee-plugins-bol-connector
 * License: GPL-2.0+
 */

namespace CoffeePlugins\BolWpPlugin;

use CoffeePlugins\BolWpPlugin\External\BigBuyApi;
use CoffeePlugins\BolWpPlugin\Hooks\Hooks_Manager;
use CoffeePlugins\BolWpPlugin\Jobs\InsertBigBuyInitialData;
use CoffeePlugins\BolWpPlugin\Options\WP_Options;
use CoffeePlugins\BolWpPlugin\Pages\Settings_Page;
use WP_Query;

if (!defined('ABSPATH')) {
  exit;
}

class Plugin
{

  const PREFIX = 'coffee_plugins_bol_connector';
  /**
   * @var Hooks_Manager An instance of the `Hooks_Manager` class.
   */
  public $hooks_manager;

  public $options;

  public $bigBuyApi;

  public $cronJobs;

  /**
   * Plugin constructor.
   */
  public function __construct()
  {
    $this->require_files();
    $this->setup_constants();

    add_action('plugins_loaded', array($this, 'init'));

    add_filter('cron_schedules', [$this, 'five_seconds_cron']);
    register_deactivation_hook(
      __FILE__,
      [$this, 'deactivation']
    );
  }

  public function deactivation()
  {

    foreach ($this->cronJobs as $job) {
      $job->cancelEvent();
    }
  }

  /**
   * Require files.
   */
  private function require_files()
  {
    require_once __DIR__ . '/autoload.php';

    $autoloader = new Autoloader();
    $autoloader->register();
  }

  /**
   * Setup constants.
   */
  private function setup_constants()
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
    $this->hooks_manager = new Hooks_Manager();
    $this->options = new WP_Options();


    $this->pages($this->options, $this->hooks_manager);
    $this->cronJobs = $this->cronJobs();

    $this->otherInitialzations();
  }

  public function cronJobs(): array
  {
    return [
      new InsertBigBuyInitialData(),
    ];
  }

  public function pages($options, $hooks_manager)
  {
    $pages = [
      new Settings_Page($options, $hooks_manager)
    ];

    foreach ($pages as $page) {
      $this->hooks_manager->register($page);
    }
  }

  public function otherInitialzations()
  {
    $bigBuyKey = $this->options->get('big_buy_api_key');

    if ($bigBuyKey !== false) {
      $this->bigBuyApi = new BigBuyApi($bigBuyKey);
    }
  }




  public function five_seconds_cron($schedules)
  {
    $schedules['five_seconds'] = array(
      'interval' => 5,
      'display'  => esc_html__('Every Five Seconds'),
    );
    return $schedules;
  }
}

new Plugin();
