<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$accordion_layout = '';
$panels_option    = $atts['panels'];

// Check if the option has some value.
if ( ! empty( $panels_option ) ) {

	// Specifying the initial settings.
	$panels_layout = '';

	// Define unique accordion identificator.
	$accordion_id = 'accordion' . fw_unique_increment();

	// Start processed panels option.
	foreach ( $panels_option as $index => $panel ) {

		// Define panel title.
		$panel_title = esc_html( $panel['title'] );

		// Define panel content.
		$panel_content = wp_kses_post( $panel['content'] );

		// Define panel icon.
		$panel_icon = esc_html( $panel['icon'] );

		// Check if the option has some value.
		if ( $panel_icon != '' ) {

			// Define the HTML layout of the panel icon.
			$panel_icon = '<i class="' . $panel_icon . '"></i>';
		}

		// Define panel collapsing.
		$panel_collapse = ( $index == 0 ) ? 'collapse show' : 'collapse';

		// Display panel only if filled title option and content option.
		if ( $panel_title != '' &&  $panel_content != '' ) {

			// Define unique panel identificator.
			$panel_id = 'collapse' . fw_unique_increment();

			// Supplement the HTML layout of the panels.
			$panels_layout .=
			'<div class="card">' .
				'<div class="card-header">' .
					'<a data-toggle="collapse" data-parent="#' . $accordion_id . '" aria-expanded="false" href="#' . $panel_id . '">' .
						$panel_icon .
						$panel_title .
					'</a>' .
				'</div>' .
				'<div class="' . $panel_collapse . '" id="' . $panel_id . '">' .
					'<div class="card-body">' .
						$panel_content .
						'<div class="clearfix"></div>' .
					'</div>' .
				'</div>' .
			'</div>';
		}
	}

	// Define the HTML layout of the accordion.
	$accordion_layout =
	'<div class="accordion panel-group" id="' . $accordion_id . '">' .
		$panels_layout .
	'</div>';
}

// Output the HTML layout of the accordion.
echo $accordion_layout;

?>
