<?php

namespace JWC\Common;

add_action( 'plugin_loaded', __NAMESPACE__ . '\remove_extra_emoji_handling' );

/**
 * Free emoji to be exactly what they are and remain optimistic that the
 * current support for emoji on devices that will actually be reading this
 * content is high. ❤️
 */
function remove_extra_emoji_handling() {

	// Don't output the inline JavaScript used to convert emoji characters
	// into Twemoji images.
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );

	// Don't output the inline styles applied to Twemoji images by default.
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );

	// Do not replace emoji with images.
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
