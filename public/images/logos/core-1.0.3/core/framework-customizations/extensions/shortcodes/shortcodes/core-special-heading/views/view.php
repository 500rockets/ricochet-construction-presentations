<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$heading_layout    = '';
$heading_title     = esc_html( $atts['title'] );
$heading_subtitle  = nl2br( esc_html( $atts['subtitle'] ) );
$heading_alignment = esc_attr( $atts['alignment'] );

// Check if title is defined.
if ( $heading_title != '' ) {

	// Define the HTML layout of the title.
	$heading_title = '<h2>' . $heading_title . '</h2>';
}

// Check if subtitle is defined.
if ( $heading_subtitle != '' ) {

	// Define the HTML layout of the subtitle.
	$heading_subtitle = '<p class="font-serif m-b-0">' . $heading_subtitle . '</p>';
}

// Check if title or subtitle is defined.
if ( ! empty( $heading_title ) || ! empty( $heading_subtitle ) ) {

	// Define the HTML layout of the heading block.
	$heading_layout =
	'<div class="module-title ' . $heading_alignment . ' m-b-0">' .
		$heading_title .
		$heading_subtitle .
	'</div>';
}

// Output the HTML layout of the divider.
echo $heading_layout;

?>
