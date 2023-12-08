<?php
namespace CoffeePlugins\BolWpPlugin\Options;

use CoffeePlugins\BolWpPlugin\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Option class to interact with the WordPress Options API.
 *
 * @see https://developer.wordpress.org/plugins/settings/options-api/
 */
class WP_Options implements Options {

    /**
     * @var array Stored options.
     */
    private $options;

    /**
     * @var array Default options.
     */
    const DEFAULT_OPTIONS = [
        'general_options' => [
            'big_buy_api_key' => '',
            'is_testing' => true
        ],
        'bigBuy_options' => [
            'save_as_draft' => false,
            
        ]
    ];

    /**
     * Options constructor.
     */
    public function __construct() {
        $all_options = array();

        foreach ( self::DEFAULT_OPTIONS as $section_id => $section_default_options ) {
            $db_option_name  = Plugin::PREFIX . '_' . $section_id;
            $section_options = get_option( $db_option_name );

            if ( $section_options === false ) {
                add_option( $db_option_name, $section_default_options );
                $section_options = $section_default_options;
            }

            $all_options = array_merge( $all_options, $section_options );
        }

        $this->options = $all_options;
    }

    /**
     * Return the option value based on the given option name.
     *
     * @param string $name Option name.
     *
     * @return mixed
     */
    public function get( $name ) {
        if ( ! isset( $this->options[ $name ] ) ) {
            return false;
        }

        return $this->options[ $name ];
    }

    /**
     * Store the given value to an option with the given name.
     *
     * @param string $name       Option name.
     * @param mixed  $value      Option value.
     * @param string $section_id Section ID. Defaults to 'general_options'.
     *
     * @return bool              Whether the option was added.
     */
    public function set( $name, $value, $section_id = 'general_options' ) {
        $db_option_name = Plugin::PREFIX . '_' . $section_id;
        $stored_option  = get_option( $db_option_name );

        $stored_option[ $name ] = $value;

        return update_option( $db_option_name, $stored_option );
    }

    /**
     * Remove the option with the given name.
     *
     * @param string $name       Option name.
     * @param string $section_id Section ID. Defaults to 'general_options'.
     *
     * @return bool              Whether the option was removed.
     */
    public function remove( $name, $section_id = 'general_options' ) {
        $initial_value = array();

        if ( isset( self::DEFAULT_OPTIONS[ $section_id ][ $name ] ) ) {
            $initial_value = self::DEFAULT_OPTIONS[ $section_id ][ $name ];
        }

        return $this->set( $name, $initial_value, $section_id );
    }

    /**
     * Return option keys.
     *
     * @return array
     */
    public static function get_option_keys() {
        return array_keys( self::DEFAULT_OPTIONS );
    }

}
