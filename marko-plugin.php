<?php
/**
 * @package MarkoPlugin
 */

/**
 * Plugin Name: Marko Plugin
 * Plugin URI: http://plugindev
 * Description:
 * Version: 1.0.0
 * Author: Marko Radulovic
 * Author: https://mlab-studio.com
 * License: GPLv3 or later
 * Text Domain: http://plugindev
 */

/**
 * Marko Plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Marko Plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Marko Plugin. If not, see https://mlab-studio.com.
 */

defined('ABSPATH') or die('You don\'t have a permission. ');

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

function activate_marko_plugin() {
    Inc\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activate_marko_plugin');

function deactivate_marko_plugin() {
    Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_marko_plugin');

if (class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}