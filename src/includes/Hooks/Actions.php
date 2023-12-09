<?php

namespace CoffeePlugins\Framework\Hooks;

// Prevent direct access to files
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

interface Actions {
    /**
     * Return the actions to register.
     *
     * @return array
     */
    public function get_actions();
}
