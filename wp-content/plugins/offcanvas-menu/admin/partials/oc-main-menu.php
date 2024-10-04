<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.enweby.com/
 * @since      1.0.0
 *
 * @package    Offcanvas_Menu
 * @subpackage Offcanvas_Menu/admin/partials
 */

?>

<style>
.enweby-plugin-title{font-size:1.8rem;}
.wrap h1{display:none;}
.enweby-admin-sidebar-settings {
	background-color: #FFFFFF;
	float: right;
	width: 30%;
	margin: 0 0 0 10px;
	border-radius: 2px;
	box-shadow: 0 0 0 1px rgb(0 0 0 / 7%), 0 1px 1px rgb(0 0 0 / 4%);
	box-sizing: border-box;
	padding: 10px 20px;
	max-width:300px;
	margin-top:0;
	top:27%;
	position:absolute;
	right:10px;
}
.wp-admin .enweby-highlight{font-size:15px;font-weight:bold;}
.wp-admin #wpbody-content .wrap{float:left;}
.wp-admin #wpbody-content .wrap .metabox-holder{width:60%;}
h3 {font-size:1.2em;}
.rate-us, .rate-us a {color:#ffb900 !important;}
.teal-color{color:darkcyan;}
@media screen and (max-width: 900px) {
	.wp-admin #wpbody-content .wrap .metabox-holder{width:unset;}
	.enweby-admin-sidebar-settings{display:none;}
}
@media screen and (max-width: 782px) {
.enweby-admin-sidebar-settings{position:absolute !important;right:0;}
.footer-upgrade{position:absolute;bottom:0;}
}

</style>
<div class="enweby-admin-sidebar-settings">
	<h3 class="teal-color"><span class="dashicons dashicons-media-document"></span> Plugin Documentation</h3>
	<p>View Plugin <a class="documentation-link" href="https://www.enweby.com/documentation/offcanvas-menu-documentation/" target="_blank">Documentation</a></p>
	
	<h3 class="teal-color"><span class="dashicons dashicons-editor-help"></span> Need Support?</h3>
	<p>Got stuck somewhere or facing an issue? Create <a target="_blank" href="https://support.enweby.com/"><strong>support ticket</strong></a> and be relaxed, we will fix your issues.</p>

	<h3 class="teal-color"><span class="dashicons dashicons-businessperson"></span> Looking for WordPress Expert?</h3>
	<p>	<span style="margin-top:5px;margin-bottom:15px;float:left;">WordPress <span class="enweby-highlight">Development @ $15/hour. No Hidden Charges.</span> Want to know more, <a href="https://www.enweby.com/hire-wordpress-developer/" target="_blank"><strong>click here</strong></a></span>
	</p>
	<h3 class="teal-color"><span class="dashicons dashicons-superhero"></span> Help us keeping this plugin free forever</h3>
	<p>WordPress is evolving everyday and it requires lots of work to maintain any plugin. <a href="https://www.enweby.com/donate-now/" target="_blank"><strong>Donate and help us</strong></a> to maintain this plugin free forever and to appreciate our efforts.<br></p>
</div>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

