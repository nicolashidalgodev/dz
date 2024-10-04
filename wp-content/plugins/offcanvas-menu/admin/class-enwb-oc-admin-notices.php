<?php
/**
 * Enwb Oc Admin Notices.
 *
 * @package Offcanvas_Menu
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Class Enwb_Oc_Admin_Notices.
 */
class Enwb_Oc_Admin_Notices {

	/**
	 * Instance
	 *
	 * @access private
	 * @var object Class object.
	 * @since 1.0.0
	 */
	private static $instance;

	/**
	 * Initiator
	 *
	 * @since 1.0.0
	 * @return object initialized object of class.
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_head', array( $this, 'remove_admin_notices' ), 20 );
			
		add_action( 'admin_init', array( $this, 'show_admin_notices' ) );
		
	}

	/**
     * Remove_all admin notices on plugin page.
     */
    public function remove_admin_notices()
    {
        $screen = get_current_screen();
        if ( in_array( $screen->id, array( 'toplevel_page_offcanvs-menu' ), true ) ) {
			?>
			<style>
			.notice{display:none!important;}
			.wpsf-notices .notice{display:none!important;}
			#enwb-oc-5-star-notice{display:block!important;margin-top:20px;}
			.enwb-notice-wrapper, #wpbody-content #setting-error-settings_updated{display:block!important;}			
			</style>
			<?php
        }		
    }
	
	/**
	 *  Show admin notices.
	 */
	public function show_admin_notices() {
		
		$image_path = esc_url( plugin_dir_url( __dir__ ) . 'admin/images/plugin-icon.png' );
		$review_url = esc_url( apply_filters( 'enwb_oc_plugin_review_url', 'https://wordpress.org/support/plugin/offcanvas-menu/reviews/?filter=5#new-post' ) );


		Enwb_Oc_Notices::add_notice(
			array(
				'id'                   => 'enwb-oc-5-star-notice',
				'type'                 => 'info',
				'class'                => 'enwb-oc-5-star',
				'show_if'              => true,
				/* translators: %1$s white label plugin name and %2$s deactivation link */
				'message'              => sprintf(
					'<div class="notice-image" style="display: flex;">
                        <img src="%1$s" class="custom-logo" alt="Icon" itemprop="logo" style="max-width: 90px;"></div>
                        <div class="notice-content">
                            <div class="notice-heading">
                                %2$s
                            </div>
                            %3$s<br />
                            <div class="enwb-review-notice-container">
                                <a href="%4$s" class="enwb-notice-close enwb-review-notice button-primary" target="_blank">
                                %5$s
                                </a>
                            <span style="color:#665;" class="dashicons dashicons-info-outline"></span>
                                <a href="#" data-repeat-notice-after="%6$s" class="enwb-notice-close enwb-review-notice">
                                %7$s
                                </a>
                            <span class="dashicons dashicons-smiley"></span>
                                <a href="#" class="enwb-notice-close enwb-review-notice">
                                %8$s
                                </a>
                            </div>
                        </div>',
					$image_path,
					__( 'Hi! Seems like you are enjoying our plugin <b>Offcanvas Mobile Menu</b>. &mdash; Thanks a ton!', 'offcanvas-menu' ),
					__( 'Could you please do us a BIG favor and give it a 5-star rating on WordPress if you like it? This would boost our motivation and help other users to make a comfortable decision while choosing the Offcanvas Mobile Menu plugin.<br> <span class="team-text"><strong>- Team Enweby</strong></span>', 'offcanvas-menu' ),
					$review_url,
					__( 'Ok, you deserve it', 'offcanvas-menu' ),
					MONTH_IN_SECONDS, // this one is being used for js file 
					__( 'Nope, maybe later', 'offcanvas-menu' ),
					__( 'I already did', 'offcanvas-menu' )
				),
				'repeat-notice-after'  => MONTH_IN_SECONDS,
				'display-notice-after' => ( 2 * WEEK_IN_SECONDS ), // Display notice after 2 weeks installation or running this code.
			)
		);
	}

	/**
	 * Check allowed screen for notices.
	 *
	 * @return bool
	 */
	public function allowed_screen_for_notices() {

		$screen          = get_current_screen();
		$screen_id       = $screen ? $screen->id : '';
		/*$allowed_screens = array(
			'woocommerce_page_fullscreen-background',
			'dashboard',
			'plugins',
		);

		if ( in_array( $screen_id, $allowed_screens, true ) ) {
			return true;
		}
		return false;*/
		return true;
	}	

}

Enwb_Oc_Admin_Notices::get_instance();
