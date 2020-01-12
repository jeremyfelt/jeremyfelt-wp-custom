<?php
/**
 * Plugin Name:     Jeremy's Custom WordPress
 * Plugin URI:      https://github.com/jeremyfelt/jeremyfelt-wp-custom/
 * Description:     A plugin to play around with default WordPress decisions.
 * Author:          Jeremy Felt
 * Author URI:      https://jeremyfelt.com
 * Version:         0.0.1
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// This plugin, like WordPress, requires PHP 5.6 and higher.
if ( version_compare( PHP_VERSION, '5.6', '<' ) ) {
	add_action( 'admin_notices', 'jcw_admin_notice' );
	/**
	 * Display an admin notice if PHP is not 5.6.
	 */
	function jcw_admin_notice() {
		echo '<div class=\"error\"><p>';
		echo __( "Jeremy's custom WordPress plugin requires PHP 5.6 to function properly. Please upgrade PHP or deactivate the plugin.", 'jf-wp-custom' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</p></div>';
	}

	return;
}

require_once __DIR__ . '/includes/common.php';
