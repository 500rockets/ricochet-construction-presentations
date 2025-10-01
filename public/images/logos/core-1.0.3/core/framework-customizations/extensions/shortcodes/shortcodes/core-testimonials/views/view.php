<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$testimonials_layout  = '';

$testimonials_type   = $atts['type'];
$testimonials_option = $atts['testimonials'];

// Check if the option has some value.
if ( ! empty( $testimonials_option ) ) {

	// Start processed testimonials option.
	foreach ( $testimonials_option as $testimonial ) {

		// Define testimonial author.
		$author = esc_html( $testimonial['author'] );

		// Define testimonial text.
		$text = esc_html( $testimonial['text'] );

		// Display testimonials only if filled author option and text option.
		if ( $author != '' && $text != '' ) {

			// Selected card type.
			if ( $testimonials_type == 'standard' ) {

				// Supplement the HTML layout of the testimonials.
				$testimonials_layout .=
				'<div class="tms-item">' .
					'<div class="tms-icons">' .
						'<h2><span class="icon icon-basic-message-multiple"></span></h2>' .
					'</div>' .
					'<div class="tms-content">' .
						'<blockquote>' .
							'<p>&ldquo;' . $text . '&rdquo;</p>' .
						'</blockquote>' .
					'</div>' .
					'<div class="tms-author"><span>' . $author . '</span></div>' .
				'</div>';

			// Selected card type.
			} elseif ( $testimonials_type == 'card' ) {

				// Define testimonial image.
				$image = esc_url( fw_akg( 'data/icon', $testimonial['image'] ) );
				$image = ( $image != '' ) ? '<img src="' . $image . '" alt="">' : '';

				// Define testimonial person job.
				$job = esc_html( $testimonial['job'] );

				// Supplement the HTML layout of the testimonials.
				$testimonials_layout .=
				'<div class="testimonials-card">' .
					'<div class="testimonials-card-photo">' .
						$image .
					'</div>' .
					'<div class="testimonials-card-content">' .
						'<p class="font-serif">' . $text . '</p>' .
					'</div>' .
					'<div class="testimonials-card-author">' .
						'<h4>' . $author . '</h4>' .
						'<p>' . $job . '</p>' .
					'</div>' .
				'</div>';
			}
		}
	}

	// Selected card type.
	if ( $testimonials_type == 'standard' ) {

		// Define the HTML layout of the testimonials.
		$testimonials_layout = '<div class="tms-slides owl-carousel">' . $testimonials_layout . '</div>';

	// Selected card type.
	} elseif ( $testimonials_type == 'card' ) {

		// Define the HTML layout of the testimonials.
		$testimonials_layout = '<div class="owl-carousel tms-carousel">' . $testimonials_layout . '</div>';
	}
}

// Output the HTML layout of the testimonials.
echo $testimonials_layout;

?>
