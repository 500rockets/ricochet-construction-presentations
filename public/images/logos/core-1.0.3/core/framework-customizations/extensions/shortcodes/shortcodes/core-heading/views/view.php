<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$heading_layout = '';
$heading_title  = esc_html( $atts['title'] );

// Display heading only if the filled title option.
if ( ! empty( $heading_title ) ) {

	// Define heading size.
	$heading_size = $atts['size'];

	// Define the HTML layout of the heading.
	$heading_layout = '<' . $heading_size . '>' . $heading_title . '</' . $heading_size . '>';

	// Define special style.
	$special_style = esc_attr( $atts['special'] );

	// Check if the option has some value.
	if ( ! empty( $special_style ) ) {

		// Define the HTML layout of the heading.
		$heading_layout = '<div class="' . $special_style . '">' . $heading_layout . '</div>';
	}
}

// Output the HTML layout of the heading.
echo $heading_layout;

?>
