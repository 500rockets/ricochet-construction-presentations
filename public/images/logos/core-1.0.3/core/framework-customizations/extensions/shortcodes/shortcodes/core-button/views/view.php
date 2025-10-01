<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

// Define the HTML layout of the button.
$button_layout =
'<div class="' . esc_attr( $atts['alignment'] ) . '">' .
	_core_get_link_layout( $atts ) .
'</div>';

// Output the HTML layout of the button.
echo $button_layout;

?>
