<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$counter_layout  = '';
$counter_title   = esc_html( $atts['title'] );
$counter_number  = esc_attr( $atts['number'] );

// Check if title is defined.
if ( $counter_title != '' ) {

	// Define the HTML layout of the title.
	$counter_title = '<div class="counter-title">' . $counter_title . '</div>';
}

// Define the HTML layout of counter.
$counter_layout =
'<div class="counter h6">' .
	'<div class="counter-number">' .
		'<div class="counter-timer" data-from="0" data-to="' . $counter_number . '">0</div>' .
	'</div>' .
	$counter_title .
'</div>';

// Output the HTML layout of the counter.
echo $counter_layout;

?>
