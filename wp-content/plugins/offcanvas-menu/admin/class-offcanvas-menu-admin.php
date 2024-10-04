<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.enweby.com/
 * @since      1.0.0
 *
 * @package    Offcanvas_Menu
 * @subpackage Offcanvas_Menu/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Offcanvas_Menu
 * @subpackage Offcanvas_Menu/admin
 * @author     Enweby <support@enweby.com>
 */
class Offcanvas_Menu_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->load_notices_files();
		$this->show_wp_menu();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Offcanvas_Menu_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Offcanvas_Menu_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/offcanvas-menu-admin.css', array(), $this->version, 'all' );

	}
	
	public function show_wp_menu() {
		add_theme_support( 'menus' );
		add_action( 'admin_body_open', array( $this, 'oc_register_menus' ) );	
	}
	
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Offcanvas_Menu_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Offcanvas_Menu_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/offcanvas-menu-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	* Load core files.
	 */
	public function load_notices_files() {		
		if ( is_admin() ) {
				require_once plugin_dir_path( __dir__ ) . 'admin/lib/enwb-notices/class-enwb-oc-notices.php';
			}

			include_once plugin_dir_path( __file__ ) . 'class-enwb-oc-admin-notices.php';
	}
	
	/**
	 * Remove_all admin notices on plugin page.
	 */
	public function remove_admin_notices() {
		$screen = get_current_screen();
		if ( in_array( $screen->id, array( 'toplevel_page_offcanvas-menu' ), true ) ) {
			remove_all_actions( 'admin_notices' );
		}
	}

	/**
	 * Display menu in appearance.
	 */
	function oc_register_menus() {
		if ( is_admin() ) {
			if (function_exists('register_nav_menus')) {	
				register_nav_menus(
						array(
						'primary-menu' => __( 'Primary Menu' ),
						'secondary-menu' => __( 'Secondary Menu' )
						)
				);
			}
		}
	}	
	
	/**
	 * To add Plugin Menu and Settings page
	 */
	public function plugin_menu_settings() {
		// Main Menu Item.
		add_menu_page(
			'Enweby OffCanvas Menu Settings',
			'Offcanvas Menu',
			'manage_options',
			'offcanvas-menu',
			array( $this, 'offcanvas_menu_main_menu' ),
			'dashicons-menu-alt3',
			60
		);
	}

	/**
	 * Admin Page Display
	 */
	public function offcanvas_menu_main_menu() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/offcanvas-menu-admin-display.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/oc-main-menu.php';
	}

	/**
	 * Setting plugin menu element
	 */
	public function menu_settings_using_helper() {

		require_once OFFCANVAS_MENU_DIR . 'vendor/boo-settings-helper/class-boo-settings-helper.php';

		$offcanvas_menu_settings = array(
			'tabs'     => true,
			'prefix'   => 'enweby_',
			'menu'     => array(
				'slug'       => $this->plugin_name,
				'page_title' => __( 'offcanvas-menu', 'offcanvas-menu' ),
				'menu_title' => __( 'Offcanvas Menu', 'offcanvas-menu' ),
				'parent'     => 'admin.php?page=offcanvas-menu',
				'submenu'    => true,
			),
			'sections' => array(
				// General Section.
				array(
					'id'    => 'oc_general_section',
					'title' => __( 'Offcanvas Menu', 'offcanvas-menu' ),
				),
			),
			'fields'   => array(
				// fields for General section.
				'oc_general_section' => array(
					array(
						'id'      => 'oc_enable_status',
						'label'   => __( 'Enable Offcanvas menu', 'offcanvas-menu' ),
						'type'    => 'checkbox',
						// phpcs:ignore
						'default' => 1,
					),
					array(
						'id'                => 'oc_menu_activate_on_device_width',
						'label'             => __( 'Set width to activate Offcanvas Menu (Default is 992)', 'offcanvas-menu' ),
						'type'              => 'number',
						'default'           => '992',
						'sanitize_callback' => 'floatval',
						'desc'              => __( 'Set pixel width to activate offcanvas menu E.g. 992', 'offcanvas-menu' ),
					),
					array(
						'id'      => 'oc_logo_image',
						'label'   => __( 'Add Site Logo for Offcanvas Menu', 'offcanvas-menu' ),
						'desc'    => __( 'This Logo will be displayed only on Offcanvas Menu', 'offcanvas-menu' ),
						'type'    => 'media',
						'default' => '',
						'options' => array(
							'btn'       => 'Add Logo',
							'max_width' => 130,
						),
					),
					array(
						'id'      => 'oc_menu_to_be_offcanvas',
						'label'   => __( 'Select Menu to convert to Offcanvas Menu', 'offcanvas-menu' ),
						'desc'    => __( 'If no menus are available \'Primary Menu\' will be used as default menu', 'offcanvas-menu' ),
						'type'    => 'select',
						'options' => $this->select_menu_ddn(),
						/*'options' => array(
							//'post_type' => 'menus',							
						),*/
					),

					array(
						'id'                => 'oc_classes_to_hide_elements',
						'label'             => __( 'Hide element with classes or Ids on any viewport width or device width', 'offcanvas-menu' ),
						'sanitize_callback' => 'sanitize_text_field',
						'desc'              => __( 'Provide comma seperated classes or Ids to hide elements in the header or other part of the site. E.g. .site-header, #navigation, #sidebar<br> **Applicable on all size of devices', 'offcanvas-menu' ),
					),
					
					array(
						'id'                => 'oc_classes_to_hide_elements_oc_width',
						'label'             => __( 'Hide element with classes or Ids only when viewport width equals/less to activate offcanvas menu', 'offcanvas-menu' ),
						'sanitize_callback' => 'sanitize_text_field',
						'desc'              => __( 'Provide comma seperated classes or Ids to hide elements in the header or other part of the site. E.g. .site-header, #navigation, #sidebar <br> **Applicable only on smaller size devices', 'offcanvas-menu' ),
					),
					array(
						'id'      => 'oc_menu_sticky',
						'label'   => __( 'Make Offcanvas Menu Sticky ', 'offcanvas-menu' ),
						'type'    => 'checkbox',
						// phpcs:ignore
						'default' => 1
					),
					array(
						'id'      => 'oc_menu_item_border',
						'label'   => __( 'Add bottom border in Menu Items', 'offcanvas-menu' ),
						'type'    => 'checkbox',
						// phpcs:ignore
						'default' => 1
					),
					array(
						'id'      => 'oc_menu_submenu_items_visible',
						'label'   => __( 'Make all submenu items visible by default', 'offcanvas-menu' ),
						'type'    => 'checkbox',
						// phpcs:ignore
						'default' => 0
					),
					array(
						'id'      => 'oc_menubar_cart_icon',
						'label'   => __( 'Display Cart Icon on Menu Bar', 'offcanvas-menu' ),
						'type'    => 'checkbox',
						// phpcs:ignore						
						'default' => 1,
					),
					array(
						'id'      => 'oc_menu_slide_cart_icon',
						'label'   => __( 'Display Cart Icon on Offcanvas Slide Panel', 'offcanvas-menu' ),
						'type'    => 'checkbox',
						// phpcs:ignore
						'default' => 1,
					),
					array(
						'id'      => 'oc_menu_search_form',
						'label'   => __( 'Display Search Box in Offcanvas Menu', 'offcanvas-menu' ),
						'type'    => 'checkbox',
						// phpcs:ignore
						// 'options' => array( 'enabled' => '0' ),.
						'default' => 0,
					),
					array(
						'id'      => 'oc_navbar_bg_color',
						'label'   => __( 'Menu Navbar Background Color', 'offcanvas-menu' ),
						'type'    => 'color',
						'default' => '#212529',
					),
					array(
						'id'      => 'oc_container_color',
						'label'   => __( 'Offcanvas Menu Container Background Color', 'offcanvas-menu' ),
						'type'    => 'color',
						'default' => '#212529',
					),
					array(
						'id'      => 'oc_menu_icon_color',
						'label'   => __( 'Offcanvas Menu Icon Color', 'offcanvas-menu' ),
						'type'    => 'color',
						'default' => '#fff',
					),
					array(
						'id'      => 'oc_text_color',
						'label'   => __( 'Offcanvas Menu Text Color', 'offcanvas-menu' ),
						'type'    => 'color',
						'default' => '#fff',
					),
					array(
						'id'      => 'oc_text_hover_color',
						'label'   => __( 'Offcanvas Menu Link Hover Color', 'offcanvas-menu' ),
						'type'    => 'color',
						'default' => '#d4f9f9',
					),
					array(
						'id'      => 'oc_border_color',
						'label'   => __( 'Select Menu Item Border Color', 'offcanvas-menu' ),
						'type'    => 'color',
						'default' => '#626262',
					),
					array(
						'id'                => 'oc_menu_text_font_size',
						'label'             => __( 'Font size for menu link text in Offcanvas Slide Panel', 'offcanvas-menu' ),
						'step'              => '1',
						'min'               => 5,
						'max'               => 40,
						'type'              => 'number',
						'default'           => '16',
						'sanitize_callback' => 'floatval',
						'desc'              => __( 'Font size for menu text in pixel', 'offcanvas-menu' ),
					),
					array(
						'id'      => 'oc_position',
						'label'   => __( 'Offcanvas Menu slide panel position to slide from', 'offcanvas-menu' ),
						'desc'    => __( 'Offcanvs menu slide panel position to slide from', 'offcanvas-menu' ),
						'type'    => 'select',
						'options' => array(
							'end'    => 'Right',
							'start'  => 'Left',							
							'top'    => 'Top',
							'bottom' => 'Bottom',
						),
					),
					array(
						'id'      => 'oc_fullscreen_option',
						'label'   => __( 'Enable full Screen Offcanvas Menu', 'offcanvas-menu' ),
						'type'    => 'checkbox',
						'default' => 0
					),
					array(
						'id'      => 'oc_shortcode_option',
						'label'   => __( 'Add ShortCode in Offcanvas Menu to display ShortCode output in the menu', 'offcanvas-menu' ),
						'type'    => 'editor',
						'desc' => 'You can add any ShortCode in the menu and result will display in Offcanvas mobile menu panel'
					),
				),
			),
		);
		new Enweby\Offcanvas\Vendor\Boo\AdminSettingsHelper\Boo_Settings_Helper( $offcanvas_menu_settings );
	}

	/**
	 * Select Menu dropdown options.
	 *
	 * @param  array $menus.
	 * @return array
	 */
	public function select_menu_ddn() {
		$available_menus = array();
		$menus  = wp_get_nav_menus();
		$available_menus['primary'] = 'Primary Menu (Default)';
		$available_menus['gutenberg_menu'] = 'Gutenberg Navigation';
		foreach( $menus as $menuItem )
		{
			$menu_slug = $menuItem->slug;
			$available_menus[$menu_slug] = ucfirst($menuItem->name);	
		}
		
		return $available_menus;
	}	
	
	/**
	 * Action links for admin.
	 *
	 * @param  array $links Array of action links.
	 * @return array
	 */
	public function plugin_action_links( $links ) {

		$settings_link = esc_url( add_query_arg( array( 'page' => 'offcanvas-menu' ), admin_url( 'admin.php' ) ) );

		$new_links['settings'] = sprintf( '<a href="%1$s" title="%2$s">%2$s</a>', $settings_link, esc_attr__( 'Settings', 'offcanvas-menu' ) );
		// phpcs:disable
		/*
		if ( ! class_exists( 'Fullscreen_Background_Pro' ) ){
			$pro_link = esc_url( add_query_arg( array( 'utm_source' => 'wp-admin-plugins', 'utm_medium' => 'go	-pro', 'utm_campaign' => 'offcanvas-menu' ), 'https://www.enweby.com/shop/wordpress-plugins/fullscreen-background-pro/' ) );
			$new_links[ 'go-pro' ] = sprintf( '<a target="_blank" style="color: #45b450; font-weight: bold;" href="%1$s" title="%2$s">%2$s</a>', $pro_link, esc_attr__('Go Pro', 'offcanvas-menu' ) );
		}*/
		// phpcs:enable
		return array_merge( $links, $new_links );
	}

	/**
	 * Plugin row meta.
	 *
	 * @param  array  $links array of row meta.
	 * @param  string $file  plugin base name.
	 * @return array
	 */
	public function plugin_row_meta( $links, $file ) {
		// phpcs:ignore
		if ( $file === OFFCANVAS_MENU_BASE_NAME ) {

			$report_url = add_query_arg(
				array(
					'utm_source'   => 'wp-admin-plugins',
					'utm_medium'   => 'row-meta-link',
					'utm_campaign' => 'offcanvas-menu',
				),
				'https://www.enweby.com/product/offcanvas-mobile-menu/#support/'
			);

			$documentation_url = add_query_arg(
				array(
					'utm_source'   => 'wp-admin-plugins',
					'utm_medium'   => 'row-meta-link',
					'utm_campaign' => 'offcanvas-menu',
				),
				'https://www.enweby.com/documentation/offcanvas-menu-documentation/'
			);

			$row_meta['documentation'] = sprintf( '<a target="_blank" href="%1$s" title="%2$s">%2$s</a>', esc_url( $documentation_url ), esc_html__( 'Documentation', 'offcanvas-menu' ) );
			// phpcs:ignore
			$row_meta['issues']        = sprintf( '%2$s <a target="_blank" href="%1$s">%3$s</a>', esc_url( $report_url ), esc_html__( '', 'offcanvas-menu' ), '<span style="color: #45b450;font-weight:bold;">' . esc_html__( 'Get Support', 'offcanvas-menu' ) . '</span>' );

			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}

}
