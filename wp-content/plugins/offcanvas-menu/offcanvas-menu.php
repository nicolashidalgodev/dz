<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.enweby.com/
 * @since             1.0.0
 * @package           Offcanvas_Menu
 *
 * @wordpress-plugin
 * Plugin Name:       Offcanvas Menu
 * Plugin URI:        https://www.enweby.com/shop/wordpress-plugins/offcanvas-menu/
 * Description:       Lightweight plugin to display offcanvas mobile menu on WordPress websites.
 * Version:           1.0.6
 * Author:            Enweby
 * Author URI:        https://www.enweby.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       offcanvas-menu
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
define( 'OFFCANVAS_MENU_VERSION', '1.0.6' );

/**
 * Plugin base name.
 * used to locate plugin resources primarily code files
 * Start at version 1.0.0
 */
define( 'OFFCANVAS_MENU_BASE_NAME', plugin_basename( __FILE__ ) );

/**
 * Plugin base dir path.
 * used to locate plugin resources primarily code files
 * Start at version 1.0.0
 */
defined( 'OFFCANVAS_MENU_DIR' ) || define( 'OFFCANVAS_MENU_DIR', plugin_dir_path( __FILE__ ) );

define( 'OFFCANVAS_MENU_PLUGIN_NAME', 'offcanvas-menu' );

define( 'OFFCANVAS_MENU_PLUGIN_VERSION', '1.0.6' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-offcanvas-menu-activator.php
 */
function activate_offcanvas_menu() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-offcanvas-menu-activator.php';
	Offcanvas_Menu_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-offcanvas-menu-deactivator.php
 */
function deactivate_offcanvas_menu() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-offcanvas-menu-deactivator.php';
	Offcanvas_Menu_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_offcanvas_menu' );
register_deactivation_hook( __FILE__, 'deactivate_offcanvas_menu' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-offcanvas-menu.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_offcanvas_menu() {

	$plugin = new Offcanvas_Menu();
	$plugin->run();

}
run_offcanvas_menu();
