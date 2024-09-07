<?php
/**
 * Plugin Name: Gausy Addons
 * Plugin URI: https://gaudev.xyz
 * Version: 0.24.9
 * Requires PHP: 8.2
 * Author: Gaudev
 * Author URI: https://gaudev.xyz
 * Text Domain: gausy-addons
 * Description: Addons plugin for Gausy Theme
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

\defined( 'ABSPATH' ) || die;

$default_headers = [
	'Name'       => 'Plugin Name',
	'Version'    => 'Version',
	'TextDomain' => 'Text Domain',
	'Author'     => 'Author',
];

$plugin_data = get_file_data( __FILE__, $default_headers, 'plugin' );

define( 'ADDONS_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) . '/' ); // https://**/wp-content/plugins/**/
define( 'ADDONS_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR ); // **\wp-content\plugins\**\
define( 'ADDONS_BASENAME', plugin_basename( __FILE__ ) ); // **/**.php

define( 'ADDONS_VERSION', $plugin_data['Version'] );
define( 'ADDONS_TEXT_DOMAIN', $plugin_data['TextDomain'] );
define( 'ADDONS_AUTHOR', $plugin_data['Author'] );

const ADDONS_SRC_PATH = ADDONS_PATH . 'src' . DIRECTORY_SEPARATOR;

if ( ! file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	error_log( 'Autoloader not found: ' . __DIR__ . '/vendor/autoload.php' );
	wp_die( __( 'Error locating autoloader. Please run <code>composer install</code>.', ADDONS_TEXT_DOMAIN ) );
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/helpers.php';

register_activation_hook( __FILE__, [ \Addons\Activator\Activator::class, 'activation' ] );
register_deactivation_hook( __FILE__, [ \Addons\Activator\Activator::class, 'deactivation' ] );
register_uninstall_hook( __FILE__, [ \Addons\Activator\Activator::class, 'uninstall' ] );

// Global function-holder. Works similar to a singleton's instance().
function plugins_loaded_addons(): void {
	require_once __DIR__ . '/Addons.php';

	( \Addons::get_instance() );
}

\plugins_loaded_addons();
