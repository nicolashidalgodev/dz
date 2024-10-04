<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.enweby.com/
 * @since      1.0.0
 *
 * @package    Offcanvas_Menu
 * @subpackage Offcanvas_Menu/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Offcanvas_Menu
 * @subpackage Offcanvas_Menu/public
 * @author     Enweby <support@enweby.com>
 */
class Offcanvas_Menu_Public {

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
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/offcanvas-menu-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-offcanvas-css', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'dashicons' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/offcanvas-menu-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . '-offcanvas-boostrap-js', plugin_dir_url( __FILE__ ) . 'js/bootstrap.bundle.min.js', array( 'jquery' ), $this->version, false );

	}

	function enwb_oc_extra_code() {
		$enweby_oc_shortcode_option = get_option( 'enweby_oc_shortcode_option', '' );
		$short_code =  do_shortcode( $enweby_oc_shortcode_option );	
		echo wp_kses_post( apply_filters( 'enwb_oc_extra_code', $short_code ) );
	}
	
	/**
	 * Setting up offcanvas menu
	 */
	public function setup_offcanvas_menu() {
		// Getting all the admin options values.
		$enweby_oc_enable_status        = get_option( 'enweby_oc_enable_status', '1' );
		$enweby_oc_logo_image           = get_option( 'enweby_oc_logo_image', '' );
		$enweby_oc_menu_sticky          = get_option( 'enweby_oc_menu_sticky', 1 );
		$enweby_oc_menu_to_be_offcanvas = get_option( 'enweby_oc_menu_to_be_offcanvas', 'primary' );
		$enweby_oc_position             = get_option( 'enweby_oc_position', 'end' );
		$enweby_oc_container_color      = get_option( 'enweby_oc_container_color', '#212529' );
		$enweby_oc_text_color           = get_option( 'enweby_oc_text_color', '#fff' );
		$enweby_oc_text_hover_color     = get_option( 'enweby_oc_text_hover_color', '#d4f9f9' );
		$enweby_oc_border_color         = get_option( 'enweby_oc_border_color', '#626262' );
		$enweby_oc_menu_item_border     = get_option( 'enweby_oc_menu_item_border', '1' );
		$enweby_oc_menu_text_font_size  = get_option( 'enweby_oc_menu_text_font_size', '1.2em' );
		$enweby_oc_menubar_cart_icon    = get_option( 'enweby_oc_menubar_cart_icon', '1' );
		$enweby_oc_menu_slide_cart_icon = get_option( 'enweby_oc_menu_slide_cart_icon', '1' );
		$enweby_oc_menu_search_form     = get_option( 'enweby_oc_menu_search_form', 0 );
		
		$enweby_oc_oc_menu_activate_on_device_width = get_option( 'enweby_oc_menu_activate_on_device_width', '991.98' );
		$enweby_oc_classes_to_hide_elements         = get_option( 'enweby_oc_classes_to_hide_elements', '' );
		$enweby_oc_fullscreen_option                = get_option( 'enweby_oc_fullscreen_option', '0' );

		if ( false !== boolval( $enweby_oc_logo_image ) ) {
			$navbar_logo_data = wp_get_attachment_image_src( $enweby_oc_logo_image, $size = 'small' );
			$navabar_logo     = ( '' !== $enweby_oc_logo_image ) ? '<img class="offcanvas-logo" src="' . $navbar_logo_data[0] . '" />' : '';
		} else {
			$navabar_logo = '<p class="oc-logo-alt">' . get_bloginfo( 'name' ) . '</p>';
		}

		$sticky_class    = ( 1 === (int) $enweby_oc_menu_sticky ) ? 'oc-fixed-top' : '';
		$html_top_margin = ( 1 === (int) $enweby_oc_menu_sticky ) ? 'margin-top:65px!important;' : '';

		$fullscreen_class = ( 1 === (int) $enweby_oc_fullscreen_option ) ? 'offcanvas-' . $enweby_oc_position . '-fullscreen' : '';
		$menu_slide_from  = $enweby_oc_position;

		if ( 1 === (int) $enweby_oc_enable_status ) {
			$classes_to_hide = $enweby_oc_classes_to_hide_elements;
			?>

		<!-- Offcanvas menu -->
		<div class="offcanvas-navigation <?php echo esc_html( $sticky_class ); ?> ">
			<div class="offcanvas offcanvas-<?php echo esc_html( $menu_slide_from ); ?>  <?php echo esc_html( $fullscreen_class ); ?> bg-dark11 navbar-dark" id="navDisplay">
				<div class="offcanvas-header">
					<h1 class="offcanvas-title"></h1>
					<button type="button" class="btn-close" data-bs-dismiss="offcanvas"><i class="dashicons dashicons-no"></i></button>
				</div>
				<div class="offcanvas-body">
				<?php
				if( 'primary' == $enweby_oc_menu_to_be_offcanvas ) {					
					wp_nav_menu(
						array(
						'menu'  		  => 'primary',
						'menu_class'      => 'navbar-nav me-auto mb-2 mb-lg-0 primary-menu',
						'after'      	  => '<span class="icon-class icon-plus1 bi bi-chevron-down"></span>',
						'container_class' => 'enwb-oc-menu-container',
						'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
						//'fallback_cb'     => false,
						)
					);
				} elseif ( 'gutenberg_menu' == $enweby_oc_menu_to_be_offcanvas ) {				
					wp_nav_menu(
						array(
							'menu'      	  => 'null',
							'menu_class'      => 'navbar-nav me-auto mb-2 mb-lg-0 first-ul gutenbrg-menu-class',
							'after'      	  => '<span class="icon-class icon-plus1 bi bi-chevron-down"></span>',	
							'container_class' => 'enwb-oc-menu-container',		
						)
					);		
				} else {
					wp_nav_menu(
						array(
							'menu'            => $enweby_oc_menu_to_be_offcanvas,
							'menu_class'      => 'navbar-nav me-auto mb-2 mb-lg-0 first-ul no-primry',
							'after'      	  => '<span class="icon-class icon-plus1 bi bi-chevron-down"></span>',
							'container_class' => 'enwb-oc-menu-container',
						)
					);

				}

				?>

				<?php
				/**
				 * Check if WooCommerce is activated
				 */
				if ( class_exists( 'woocommerce' ) ) {
					if ( 1 === (int) $enweby_oc_menu_slide_cart_icon ) {
						?>
							<div class="offcanvas-cart-link">
								<?php echo wp_kses_post( $this->oc_woo_cart_item_count() ); ?>
							</div>
						<?php
					}
				}

				if ( 1 === (int) $enweby_oc_menu_search_form ) {
					?>
				<div class="oc-search-form">
					<?php get_search_form(); ?>
				</div>
				<?php } ?>
				
				<div class="enwb-oc-extra-code">
				
					<?php do_action('enwb_oc_extra_code_action'); ?>

				</div>
				
				</div>
			</div>
			<!-- Button to open the offcanvas sidebar -->
			<div class="container-fluid-rf navbar navbar-expand-lg navbar-dark bg-dark offcanvas-nav">
				<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>"><?php echo wp_kses_post( $navabar_logo ); ?></a>
			<?php
				/**
				 * Check if WooCommerce is activated
				 */
			if ( class_exists( 'woocommerce' ) ) {
				if ( 1 === (int) $enweby_oc_menubar_cart_icon ) {
					?>
							<div class="offcanvas-cart-link">
							<?php echo wp_kses_post( $this->oc_woo_cart_item_count() ); ?>
							</div>
					<?php
				}
			}
			?>
				<div class="menu-icon-etc">
					<div class="enwb-oc-before-menu-icon"><?php do_action('enwb_oc_before_menu_icon'); ?></div>
					<button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navDisplay">
						<i class="dashicons dashicons-menu"></i>
					</button>
				</div>	
			</div>
		</div>
			<?php
		}
	}

	/**
	 * Setting up offcanvas custom style settings
	 */
	public function get_oc_custom_styles() {
		// Getting all the admin options values.
		$enweby_oc_enable_status       = get_option( 'enweby_oc_enable_status', '1' );
		$enweby_oc_menu_sticky         = get_option( 'enweby_oc_menu_sticky', 1 );
		$enweby_oc_navbar_bg_color     = get_option( 'enweby_oc_navbar_bg_color', '#212529' );
		$enweby_oc_container_color     = get_option( 'enweby_oc_container_color', '#212529' );
		$enweby_oc_text_color          = get_option( 'enweby_oc_text_color', '#fff' );
		$enweby_oc_menu_icon_color     = get_option( 'enweby_oc_menu_icon_color', '#fff' );
		$enweby_oc_text_hover_color    = get_option( 'enweby_oc_text_hover_color', '#d4f9f9' );
		$enweby_oc_border_color        = get_option( 'enweby_oc_border_color', '#626262' );
		$enweby_oc_menu_item_border    = get_option( 'enweby_oc_menu_item_border', '1' );
		$enweby_oc_menu_text_font_size = get_option( 'enweby_oc_menu_text_font_size', '1.2em' );

		$enweby_oc_menu_submenu_items_visible  		= get_option( 'enweby_oc_menu_submenu_items_visible', 0 );
		$enweby_oc_oc_menu_activate_on_device_width = get_option( 'enweby_oc_menu_activate_on_device_width', '991.98' );
		$enweby_oc_classes_to_hide_elements         = get_option( 'enweby_oc_classes_to_hide_elements', '' );
		$enweby_oc_classes_to_hide_elements_oc_width         = get_option( 'enweby_oc_classes_to_hide_elements_oc_width', '' );

		$sticky_class    = ( 1 === (int) $enweby_oc_menu_sticky ) ? 'oc-fixed-top' : '';
		$html_top_margin = ( 1 === (int) $enweby_oc_menu_sticky ) ? '-margin-top:65px!important;' : '';

		if ( 1 === (int) $enweby_oc_enable_status ) {
			$classes_to_hide = $enweby_oc_classes_to_hide_elements;
			$classes_to_hide_os_width = $enweby_oc_classes_to_hide_elements_oc_width
			?>
			<style>
			<?php echo wp_kses_post( $classes_to_hide ); ?> {display:none !important;}
			@media (min-width: <?php echo esc_attr( $enweby_oc_oc_menu_activate_on_device_width + 0.02 ) . 'px'; ?>) {
			.offcanvas-navigation{display:none;}
			.offcanvas{visibility:hidden;}
			}
			@media (max-width: <?php echo esc_attr( $enweby_oc_oc_menu_activate_on_device_width ) . 'px'; ?>) {
			body.admin-bar{<?php echo esc_html( $html_top_margin ); ?>}
			<?php echo wp_kses_post( $classes_to_hide_os_width ); ?> {display:none !important;}
			header.enweby-offcanvas-enabled{display:none;}
			.site-header{display:none;}
			.nav, .main-navigation, .genesis-nav-menu, #main-header, #et-top-navigation, .site-header, .site-branding, .ast-mobile-menu-buttons, .storefront-handheld-footer-bar, .hide{display:none!important;}
			#wpadminbar{z-index:1000;}
			.offcanvas-navigation .navbar {background-color:<?php echo esc_html( $enweby_oc_navbar_bg_color ); ?> !important;}
			.offcanvas-navigation .offcanvas {background-color:<?php echo esc_html( $enweby_oc_container_color ); ?>;}
			.offcanvas-navigation .navbar-toggler {color: <?php echo esc_html( $enweby_oc_menu_icon_color ); ?> !important; border-color:<?php echo esc_html( $enweby_oc_menu_icon_color ); ?>!important;}
			.offcanvas-navigation .offcanvas-header .btn-close {height:35px; cursor:pointer;border:none !important;color:#000!important;background: <?php echo esc_html( $enweby_oc_menu_icon_color ); ?> !important;}
			.offcanvas-navigation .offcanvas .navbar-nav li a, .offcanvas-navigation .offcanvas .navbar-nav li a:visited {color:<?php echo esc_html( $enweby_oc_text_color ); ?>!important; font-size:<?php echo esc_html( $enweby_oc_menu_text_font_size ) . 'px'; ?>;}
			.offcanvas-navigation .offcanvas .navbar-nav li a:hover{color:<?php echo esc_html( $enweby_oc_text_hover_color ); ?>!important;}
			.offcanvas-navigation .navbar-nav li.menu-item-has-children > span.bi:hover::before{color:<?php echo esc_html( $enweby_oc_text_hover_color ); ?>!important;}

			.offcanvas-navigation .offcanvas .navbar-nav li span.bi{color:<?php echo esc_html( $enweby_oc_text_color ); ?>!important;}
			.offcanvas-navigation .offcanvas-header .btn-close .bi{color:<?php echo esc_html( $enweby_oc_text_color ); ?>!important; opacity:1;}
			.offcanvas-navigation .offcanvas-header .btn-close .bi:hover{color:<?php echo esc_html( $enweby_oc_text_hover_color ); ?>!important;}
			<?php if ( 1 === (int) $enweby_oc_menu_item_border ) { ?>
			.offcanvas-navigation .navbar-nav li, .offcanvas .offcanvas-cart-link {list-style:none;border-top:1px solid <?php echo esc_html( $enweby_oc_border_color ); ?>;}
			.offcanvas-navigation .first-ul{border-bottom:1px solid <?php echo esc_html( $enweby_oc_border_color ); ?>;}
			<?php } ?>
			<?php if ( 1 === (int) $enweby_oc_menu_submenu_items_visible ) { ?>
			.offcanvas-navigation ul.sub-menu{display:block;}
			<?php } ?>
			
			<?php  
			$enweby_oc_menu_to_be_offcanvas = get_option( 'enweby_oc_menu_to_be_offcanvas', '' );
			if( 'gutenberg_menu'  == $enweby_oc_menu_to_be_offcanvas )  {
			?>
			.offcanvas-navigation .navbar-nav ul.wp-block-navigation__container{display:block !important; padding:0;}
			.offcanvas-navigation .navbar-nav ul.wp-block-page-list {display:block !important; padding:0;}
			<?php } ?>	
			
			}
			</style>
			<?php 
			$enweby_oc_menu_to_be_offcanvas = get_option( 'enweby_oc_menu_to_be_offcanvas', '' );
			if( 'gutenberg_menu'  == $enweby_oc_menu_to_be_offcanvas )  {
			?>
			<script>
			jQuery(function(){
				var gutenbergNav = jQuery('.wp-block-navigation__responsive-container-content').html();
				//jQuery('.offcanvas-navigation div.navbar-nav').append( gutenbergNav );
				if( jQuery( '.offcanvas-body' ).find('.enwb-oc-menu-container').length > 0 ) {				
					jQuery('.offcanvas-navigation .offcanvas-body .enwb-oc-menu-container').html( '<div class="navbar-nav me-auto mb-2 mb-lg-0">' + gutenbergNav + '</div>' );
				} else {
					jQuery('.offcanvas-navigation div.navbar-nav').append( gutenbergNav );
				}
			});
			</script>
			<?php
			}
		}
	}

	/**
	 * [oc_woo_cart_item_count description]
	 *
	 * @return string html string
	 */
	public function oc_woo_cart_item_count() {
		ob_start();

		$cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count.
		$cart_url   = wc_get_cart_url();  // Set Cart URL.

		?>
		<a class="menu-item cart-contents" href="<?php echo esc_url( $cart_url ); ?>" title="<?php esc_html_e( 'View Cart' ); ?>">
		<i class="bi bi-cart2"></i>
		<?php
		if ( $cart_count > 0 ) {
			?>
			<span class="cart-contents-count"><?php echo esc_html( $cart_count ); ?></span>
			<?php
		}
		?>
		</a>
		<?php

		return ob_get_clean();

	}

	/**
	 * [oc_woo_cart_update_count description]
	 *
	 * @param  string $fragments html string.
	 * @return string            html string
	 */
	public function oc_woo_cart_update_count( $fragments ) {
		ob_start();

		$cart_count = WC()->cart->cart_contents_count;
		$cart_url   = wc_get_cart_url();

		?>
		<a class="cart-contents menu-item" href="<?php echo esc_url( $cart_url ); ?>" title="<?php esc_html_e( 'View Cart' ); ?>">
		<i class="bi bi-cart2"></i>
		<?php
		if ( $cart_count > 0 ) {
			?>
		<span class="cart-contents-count"><?php echo esc_html( $cart_count ); ?></span>
			<?php
		} else {
			?>
		<span class="cart-contents-count"><?php echo absint( 0 ); ?> </span>
			<?php
		}
		?>
		</a>
		<?php
		$fragments['a.cart-contents'] = ob_get_clean();
		return $fragments;
	}
}
