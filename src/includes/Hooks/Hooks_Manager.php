<?php

namespace CoffeePlugins\Framework\Hooks;

use CoffeePlugins\Framework\Utils;

// Prevent direct access to files
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class HooksManager {

    /**
     * Register an object.
     *
     * @param object $object
     */
    public function register( $object ) {
        if ( $object instanceof Actions ) {
            $this->registerActions( $object );
        }

        if ( $object instanceof Filters ) {
            $this->registerFilters( $object );
        }
    }

    /**
     * Register the actions of the given object.
     *
     * @param object $object
     */
    private function registerActions( $object ) {
        $actions = $object->get_actions();

        foreach ( $actions as $action_name => $action_details ) {
            $method        = $action_details[0];
            $priority      = Utils::default_value( $action_details[1], 10 );
            $accepted_args = Utils::default_value( $action_details[2], 1 );

            add_action(
                $action_name,
                array( $object, $method ),
                $priority,
                $accepted_args
            );
        }
    }

    /**
     * Register the filters of the given object.
     *
     * @param object $object
     */
    private function registerFilters( $object ) {
        $filters = $object->get_filters();

        foreach ( $filters as $filter_name => $filter_details ) {
            $method        = $filter_details[0];
            $priority      = Utils::default_value( $filter_details[1], 10 );
            $accepted_args = Utils::default_value( $filter_details[2], 1 );

            add_filter(
                $filter_name,
                array( $object, $method ),
                $priority,
                $accepted_args
            );
        }
    }

}
