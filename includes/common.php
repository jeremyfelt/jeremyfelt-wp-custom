<?php

namespace JWC\Common;

add_action( 'plugins_loaded', __NAMESPACE__ . '\remove_extra_emoji_handling' );
add_action( 'plugins_loaded', __NAMESPACE__ . '\remove_default_actions' );
add_action( 'plugins_loaded', __NAMESPACE__ . '\dequeue_global_styles' );

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
	remove_action( 'embed_head', 'print_emoji_detection_script' );

	// Don't output the inline styles applied to Twemoji images by default.
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );

	// Do not replace emoji with images.
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}

/**
 * Remove other default actions that output unnecessary elements or do
 * unnecessary things.
 */
function remove_default_actions() {

	// There is a very close to zero chance I will ever use Windows Live Writer.
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// I can't ever imagine wanting a shortlink in today's internet, but that may
	// just be me.
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
}

add_filter( 'wp_resource_hints', __NAMESPACE__ . '\remove_wp_org_cdn_prefetch' );

/**
 * Remove unnecessary DNS prefetch for s.w.org.
 */
function remove_wp_org_cdn_prefetch( $urls ) {

	foreach( $urls as $key => $url ) {

		// Look for the likely URL controlling emoji images.
		if ( mb_strpos( $url, 's.w.org/images/core/emoji' ) ) {
			unset( $urls[ $key ] );
		}
	}

	return $urls;
}

/**
 * Stop both Gutenberg and WordPress from enqueuing default color palette and gradient
 * styles on every page view.
 *
 * This is probably a bad idea somehow.
 */
function dequeue_global_styles() {
	remove_action( 'wp_enqueue_scripts', 'gutenberg_experimental_global_styles_enqueue_assets' );
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
}
