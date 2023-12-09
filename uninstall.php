<?php
namespace CoffeePlugins\Framework;

use CoffeePlugins\Framework\Options\WPOptions;
use CoffeePlugins\Framework\Plugin\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/src/includes/Options/WPOptions.php';

foreach ( WPOptions::get_option_keys() as $option_key ) {
    $db_option_name = Plugin::prefix() . '_' . $option_key;
    delete_option( $db_option_name );
}
