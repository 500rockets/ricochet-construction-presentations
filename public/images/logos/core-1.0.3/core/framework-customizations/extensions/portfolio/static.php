<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$static_folder = fw_get_template_customizations_directory_uri() . '/extensions/portfolio/static';

// Check if there is not admin area.
if ( ! is_admin() ) {

	// Filter Loader styles.
	wp_enqueue_style(
		'core-filter-loader',
		$static_folder . '/css/filterloader.css'
	);

	// Infinite Scroll plugin.
	wp_enqueue_script(
		'core-infinite-scroll',
		$static_folder . '/js/infinitescroll.min.js',
		array( 'jquery' ),
		false, true
	);

	// Filters integration scripts.
	wp_enqueue_script(
		'core-filter-infscr',
		$static_folder . '/js/filterinfscr.js',
		array( 'jquery' ),
		false, true
	);
}

?>
