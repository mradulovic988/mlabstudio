<?php
/**
 * @package MarkoPlugin
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class Admin extends BaseController
{
    public $settings;
    public $pages = array();

    public function __construct() {

        $this->settings = new SettingsApi();

        $this->pages = array(
            array(
                'page_title'    => 'M LabStudio',
                'menu_title'    => 'M LabStudio',
                'capability'    => 'manage_options',
                'menu_slug'     => 'marko_plugin',
                'callback'      => function() { echo '<h1>M LabStudio Plugin Page</h1>'; },
                'icon_url'      => 'dashicons-shield',
                'position'      => 1
            ),
        );
    }

    public function register() {
        $this->settings->addPages($this->pages)->register();
    }

}