<?php

// Define the URI to the folder with the statics.
$static_folder = get_template_directory_uri() . '/includes/static';

// Enqueue Smooth Scroll scripts.
wp_enqueue_script(
	'core-smooth-scroll',
	$static_folder . '/js/smooth-scroll.js',
	array( 'jquery', 'core-custom-scripts' ),
	false, true
);



/**
 * Any action taken when installed and activated the Contact Form 7 plugin.
 *
 * @link https://wordpress.org/plugins/contact-form-7
 */
if ( defined( 'WPCF7_VERSION' ) && ! defined( 'CF7BS_VERSION' ) ) {

	// Enqueue contact forms styles.
	wp_enqueue_style(
		'core-wpcf7-styles',
		$static_folder . '/css/wpcf7-styles.css'
	);

	// Enqueue contact forms scripts.
	wp_enqueue_script(
		'core-wpcf7-scripts',
		$static_folder . '/js/wpcf7-scripts.js',
		array( 'jquery' ),
		false, true
	);
}

?>
