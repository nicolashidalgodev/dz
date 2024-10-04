/**
 * All of the js for your public-facing functionality should be.
 * included in this file.
 *
 * @link              https://www.enweby.com/
 * @since             1.0.0
 * @package           Offcanvas_Menu
 */

(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$(
		function(){
			//default
			$( ".wp-block-navigation" ).closest('header').addClass('enweby-offcanvas-enabled');
				
			
			$( ".navbar-nav li span.icon-class" ).click(
				function(){
					$( this ).parent().children( "ul.sub-menu" ).toggle();
					$( this ).parent().children( "span.icon-class" ).toggleClass( "bi-chevron-down bi-chevron-up" );
				}
			);
		}
	);

})( jQuery );
