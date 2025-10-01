<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$pricing_table_layout = '';

// Specifying the initial settings.
$table_attributes = array( 'class' => array( 'pricing-wrapper' ) );

// Start processed table price option
$table_price = esc_html( $atts['price'] );

// Check if the option has some value.
if ( $table_price != '' ) {

	// Define the HTML layout of the pricing table price.
	$table_price =
	'<div class="pricing-price">' .
		'<h5>' .
			'<span><i class="' . $atts['currency'] . '"></i></span>' .
			$table_price .
		'</h5>' .
	'</div>';
}

// Start processed table title and subtitle options.
$table_header = '';

// Define table title.
$table_title = esc_html( $atts['title'] );
$table_title = ( $table_title != '' ) ? '<h4>' . $table_title . '</h4>' : '';

// Define table subtitle.
$table_subtitle = esc_html( $atts['subtitle'] );
$table_subtitle = ( $table_subtitle != '' ) ? '<p class="m-t-10 m-b-0">' . $table_subtitle . '</p>' : '';

// Define the need for output pricing table header.
if ( ! empty( $table_title ) || ! empty( $table_subtitle ) ) {

	// Define the HTML layout of the pricing table header.
	$table_header =
	'<div class="pricing-header">' .
		$table_title .
		$table_subtitle .
	'</div>';
}

// Start processed features option.
$table_features = '';

// Check if the option has some value.
if ( ! empty( $atts['features'] ) ) {

	foreach( $atts['features'] as $feature ) {

		$feature_name = esc_html( $feature['name'] );

		// Check if the option has some value.
		if ( $feature_name != '' ) {

			// Check the need to cross out the feature name.
			if ( $feature['decoration'] ) { $feature_name = '<strike>' . $feature_name . '</strike>'; }

			// Supplement the HTML layout of the features.
			$table_features .= '<li>' . $feature_name . '</li>';
		}
	}

	// Define the need for output features.
	if ( ! empty( $table_features ) ) {

		// Define the HTML layout of the features.
		$table_features =
		'<div class="pricing-body">' .
			'<ul class="pricing-features">' .
				$table_features .
			'</ul>' .
		'</div>';
	}
}

// Start processed button option.
$table_button      = '';
$show_table_button = ( fw_akg( 'button/display_choice', $atts ) == 'show' );

// Check whether to show the button.
if ( $show_table_button ) {

	// Define button settings.
	$button_options = fw_akg( 'button/show', $atts );

	// Define the HTML layout of the table button.
	$table_button = '<div class="pricing-footer">' . _core_get_link_layout( $button_options ) . '</div>';
}

// Start processed of the styles option.
if ( ! empty( $atts['style'] ) ) {

	// Supplement the set of styles.
	$table_attributes['class'] = array_merge( $table_attributes['class'], array_keys( $atts['style'], true ) );
}

// Convert the attributes to string.
$table_attributes = core_attr_to_html( $table_attributes );

// Define the HTML layout of the pricing table.
$pricing_table_layout =
'<div ' . $table_attributes . '>' .
	$table_header .
	$table_price .
	$table_features .
	$table_button .
'</div>';

// Output the HTML layout of the pricing table.
echo $pricing_table_layout;

?>
