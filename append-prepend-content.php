<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://bowo.io
 * @since             1.1.0
 * @package           Append_Prepend_Content
 *
 * @wordpress-plugin
 * Plugin Name:       Append Prepend Content
 * Plugin URI:        https://github.com/qriouslad/append-prepend-content
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Bowo
 * Author URI:        https://bowo.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       append-prepend-content
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'APPEND_PREPEND_CONTENT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-append-prepend-content-activator.php
 */
function activate_append_prepend_content() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-append-prepend-content-activator.php';
	Append_Prepend_Content_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-append-prepend-content-deactivator.php
 */
function deactivate_append_prepend_content() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-append-prepend-content-deactivator.php';
	Append_Prepend_Content_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_append_prepend_content' );
register_deactivation_hook( __FILE__, 'deactivate_append_prepend_content' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-append-prepend-content.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_append_prepend_content() {

	$plugin = new Append_Prepend_Content();
	$plugin->run();

}
run_append_prepend_content();
