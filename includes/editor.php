<?php

namespace JWC\Editor;

add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\remove_classic_admin_enqueues' );
add_action( 'admin_bar_init', __NAMESPACE__ . '\remove_classic_admin_bar' );

/**
 * Remove classic admin scripts and styles where possible when the block
 * editor is loaded.
 *
 * Note: If the block editor is not used in full screen mode, then the
 *       experience will get worse, not better.
 */
function remove_classic_admin_enqueues() {
	if ( get_current_screen()->is_block_editor() ) {
		// Colors has a lot of stylesheet friends that just *poof* away.
		wp_dequeue_style( 'colors' );

		// This removes common, which removes hoverIntent, both of which
		// appear unnecessary after dequeueing the admin bar.
		wp_dequeue_script( 'common' );
	}
}

/**
 * Gutenberg no longer displays the admin bar. Remove associated
 * scripts and styles.
 *
 * Note: If the block editor is not used in full screen mode, then the
 *       experience will get worse, not better.
 */
function remove_classic_admin_bar() {
	// The current screen isn't set yet.
	global $pagenow;

	if ( in_array( $pagenow, array( 'post.php', 'post-new.php' ), true ) ) {
		wp_dequeue_style( 'admin-bar' );
		wp_dequeue_script( 'admin-bar' );
	}
}
