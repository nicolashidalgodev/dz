<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.enweby.com/
 * @since      1.0.0
 *
 * @package    Offcanvas_Menu
 * @subpackage Offcanvas_Menu/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Offcanvas_Menu
 * @subpackage Offcanvas_Menu/includes
 * @author     Enweby <support@enweby.com>
 */

// phpcs:ignore
class Offcanvas_Menu_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'offcanvas-menu',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
