<?php

namespace CoffeePlugins\BolWpPlugin\Pages;

use CoffeePlugins\BolWpPlugin\Hooks\Actions;

use CoffeePlugins\BolWpPlugin\Hooks\Hooks_Manager;
use CoffeePlugins\BolWpPlugin\Sections\Fields\Elements\Element;
use CoffeePlugins\BolWpPlugin\Statistics\Active_Lockouts;
use CoffeePlugins\BolWpPlugin\Statistics\Total_Lockouts;
use CoffeePlugins\BolWpPlugin\Standalone\Lockout_Logs;
use CoffeePlugins\BolWpPlugin\Standalone\Admin_Notice;
use CoffeePlugins\BolWpPlugin\IP_Address;
use CoffeePlugins\BolWpPlugin\Options\Options;
use CoffeePlugins\BolWpPlugin\Plugin;
use CoffeePlugins\BolWpPlugin\Utils;

if (!defined('ABSPATH')) {
    exit;
}

class Settings_Page extends Admin_Page implements Actions
{

    /**
     * @var Hooks_Manager
     */
    private $hooksManager;

    /**
     * Settings_Page constructor.
     *
     * @param Hooks_Manager $hooks_manager
     * @param Options       $options
     */
    public function __construct($options, $hooks_manager)
    {
        parent::__construct($options);

        $this->hooksManager = $hooks_manager;
    }

    /**
     * Return the actions to register.
     *
     * @return array
     */
    public function get_actions()
    {
        return parent::get_actions();
    }

    /**
     * Return the menu title.
     *
     * @return string
     */
    protected function get_menu_title()
    {
        return 'Bol.com Connector';
    }

    /**
     * Return the page title.
     *
     * @return string
     */
    protected function get_page_title()
    {
        return 'CoffeePlugins Bol.com Connector';
    }

    /**
     * Return the menu icon as a dashicon.
     *
     * @link https://developer.wordpress.org/resource/dashicons/
     *
     * @return string
     */
    protected function get_icon_url()
    {
        return 'dashicons-shield-alt';
    }

    /**
     * Return page slug.
     *
     * @return string
     */
    public function get_slug()
    {
        return Plugin::PREFIX . '_settings';
    }

    /**
     * Register sections.
     */
    public function register_sections()
    {
        $generalOptionsSection = $this->register_section(
            'general_options',
            array('title' => 'BigBuy Settings')
        );

        $bigbuyApiKeyField = $generalOptionsSection->add_field(
            array('label' => 'BigBuy Settings')
        );

        $bigbuyApiKeyField->add_element(
            Element::TEXT_ELEMENT,
            array(
                'label' => 'BigBuy API Key',
                'name' => 'big_buy_api_key'
            )
        );

        $bigbuyApiKeyField->add_element(
            Element::CHECKBOX_ELEMENT,
            [
                'label' => 'Use Testing',
                'name' => 'is_testing'
            ]
        );
    }
}
