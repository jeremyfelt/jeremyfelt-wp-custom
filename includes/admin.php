<?php

namespace JWC\Admin;

add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\enqueue_dashboard_css' );

/**
 * Enqueue a custom stylesheet on the dashboard.
 */
function enqueue_dashboard_css() {
	if ( get_current_screen() && 'dashboard' === get_current_screen()->id ) {
		wp_enqueue_style(
			'jwc-dashboard',
			plugin_dir_url( __DIR__ ) . '/css/dashboard.css',
			false
		);
	}
}
