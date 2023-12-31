<?php

namespace CoffeePlugins\Framework\Hooks;

// Prevent direct access to files
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

interface Filters {
    /**
     * Return the filters to register.
     *
     * @return array
     */
    public function get_filters();
}