<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$pie_chart_layout  = '';
$pie_chart_filling = esc_attr( $atts['filling'] );

// Specifying the initial settings.
$attributes = array(
	'data-percent' => $pie_chart_filling,
);

// Start processed of the title option.
$pie_chart_title = esc_html( $atts['title'] );

// Check if title is defined.
if ( $pie_chart_title != '' ) {

	// Define the HTML layout of the title.
	$pie_chart_title = '<div class="chart-title"><h5>' . $pie_chart_title . '</h5></div>';
}

// Define pie chart color type.
$pie_chart_color_type = fw_akg( 'color_choice', $atts['color'] );

// Selected custom color type.
if ( $pie_chart_color_type == 'custom' ) {

	$pie_chart_color = esc_attr( fw_akg( 'custom/color', $atts['color'] ) );

// Selected brand color type.
} elseif ( $pie_chart_color_type == 'brand' ) {

	$pie_chart_color = esc_attr( _core_get_brand_color() );
}

// Check if successfully got the color.
if ( isset( $pie_chart_color ) && ! empty( $pie_chart_color ) ) {

	// Define the value of the pie chart options attribute.
	$color_attr_value = '{"barColor":"' . $pie_chart_color . '"}';

	// Set pie chart options attribute.
	$attributes['data-chart-options'] = $color_attr_value;
}

// Convert the attributes to string.
$attributes = core_attr_to_html( $attributes );

// Define the HTML layout of the pie chart.
$pie_chart_layout =
'<div class="pie-chart">' .
	'<div class="chart" ' . $attributes . '>' .
		'<div class="chart-text">' .
			'<h5><span>' . $pie_chart_filling . '</span>&#37;</h5>' .
		'</div>' .
	'</div>' .
	$pie_chart_title .
'</div>';

// Output the HTML layout of the pie chart.
echo $pie_chart_layout;

?>
