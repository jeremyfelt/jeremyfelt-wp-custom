<?php

namespace JWC\BlockPatterns;

// WordPress core registers default patterns on priority 11.
add_action( 'init', __NAMESPACE__ . '\unregister_block_patterns', 11 );

/**
 * Unregister any block patterns that I don't use.
 *
 * This may (?) speed up the editor a bit and does (certainly) clean
 * up the console log, which is currently full of block transformation
 * notices for these patterns.
 */
function unregister_block_patterns() {
	$patterns = array(
		// Patterns registered in Twenty Twenty One
		'twentytwentyone/large-text',
		'twentytwentyone/links-area',
		'twentytwentyone/media-text-article-title',
		'twentytwentyone/overlapping-images',
		'twentytwentyone/two-images-showcase',
		'twentytwentyone/overlapping-images-and-text',
		'twentytwentyone/contact-information',
		'twentytwentyone/portfolio-list',

		// Patterns registered in WordPress Core.
		'core/text-two-columns',
		'core/two-buttons',
		'core/two-images',
		'core/text-two-columns-with-images',
		'core/text-three-columns-buttons',
		'core/large-header',
		'core/large-header-button',
		'core/three-buttons',
		'core/heading-paragraph',
		'core/quote',
	);

	foreach ( $patterns as $pattern ) {
		unregister_block_pattern( $pattern );
	}
}
