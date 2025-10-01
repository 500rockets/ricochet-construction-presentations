<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$progress_bars_layout = '';
$progress_bars_option = $atts['progress_bars'];

foreach ( $progress_bars_option as $progress_bar ) {

	// Specifying the initial settings.
	$attributes = array(
		'class' => array(
			'progress-bar',
			'progress-bar-brand',
			esc_attr( $progress_bar['striped'] ),
		),
	);

	// Define progress bar title.
	$progress_title = esc_html( $progress_bar['title'] );

	// Define progress bar filling.
	$progress_filling = esc_attr( $progress_bar['filling'] );

	// Check if the options has some values.
	if ( ! empty( $progress_title ) && ! empty( $progress_filling ) ) {

		// Convert the attributes to string.
		$attributes = core_attr_to_html( $attributes );

		// Define the HTML layout of the progress bar.
		$progress_bars_layout .=
		'<div class="progress-item">' .
			'<div class="progress-title">' .
				$progress_title .
			'</div>' .
			'<div class="progress">' .
				'<div ' . $attributes . ' aria-valuenow="' . $progress_filling . '" role="progressbar" aria-valuemin="0" aria-valuemax="100">' .
					'<span class="pb-number-box">' .
						'<span class="pb-number"></span>&#37;' .
					'</span>' .
				'</div>' .
			'</div>' .
		'</div>';
	}
}

// Output the HTML layout of the progress bar.
echo $progress_bars_layout;

?>
