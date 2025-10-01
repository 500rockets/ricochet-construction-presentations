<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$divider_layout = '';

if ( $atts['height'] != '' ) {
	$divider_height = (int) $atts['height'];
	$indent_type    = ( $divider_height < 0 ) ? 'margin-top' : 'padding-top';
	$divider_layout = '<div class="core-divider-space" style="' . $indent_type . ': ' . $divider_height . 'px;"></div>';
}

// Output the HTML layout of the divider.
echo $divider_layout;

?>
