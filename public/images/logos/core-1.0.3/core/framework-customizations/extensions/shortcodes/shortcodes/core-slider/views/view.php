<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$slider_layout       = '';
$images_option_value = $atts['images'];

// Check if the option has some value.
if ( ! empty( $images_option_value ) ) {

	// Specifying the initial settings.
	$carousel_options = '';
	$images_items     = '';

	foreach ( $images_option_value as $image_data ) {

		// Define image URL.
		$image_url = fw_akg( 'data/icon', $image_data );

		// Define image attachment ID.
		$attachment_id = fw_akg( 'custom', $image_data );

		// Check if the option has some value.
		if ( ! empty( $attachment_id ) ) {

			// Supplement the HTML layout of the set of images.
			$images_items .= wp_get_attachment_image( $attachment_id, 'full' );
		}
	}

	// Define the need for output images.
	if ( ! empty( $images_items ) ) {

		// Check if transition style is defined.
		if ( ! empty( $atts['transition'] ) ) {

			// Define the value of the carousel options attribute.
			$carousel_options = esc_attr( '{"transitionStyle":"' . $atts['transition'] . '"}' );
		}

		// Define the HTML layout of the slider.
		$slider_layout =
		'<div class="image-slider owl-carousel" data-carousel-options="' . $carousel_options . '">' .
			$images_items .
		'</div>';
	}
}

// Output the HTML layout of the slider.
echo $slider_layout;

?>
