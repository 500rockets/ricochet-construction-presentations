<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$clients_block_layout = '';
$clients_block_type   = $atts['type'];
$items_option_value   = $atts['items'];
$images_option_value  = $atts['images'];

// Check if the option has some value.
if ( ! empty( $images_option_value ) ) {

	// Specifying the initial settings.
	$clients_images = array();

	foreach ( $images_option_value as $image_data ) {

		// Define client image URL.
		$image_url = fw_akg( 'data/icon', $image_data );

		// Check if the option has some value.
		if ( ! empty( $image_url ) ) {

			// Supplement the set of clients images.
			$clients_images[] = $image_url;
		}
	}

	// Check if clients images is not empty.
	if ( ! empty( $clients_images ) ) {

		// Specifying the initial settings.
		$clients_items = '';

		foreach ( $clients_images as $index => $image_url ) {

			// Specifying the initial settings.
			$client_item = '<div class="client"><img src="' . esc_url( $image_url ) . '" alt=""></div>';

			// Selected carousel type.
			if ( $clients_block_type == 'carousel' ) {

				// Supplement the HTML layout of the set of clients.
				$clients_items .= $client_item;

			// Selected grid type.
			} elseif ( $clients_block_type == 'grid' ) {

				// Specifying the initial settings.
				$images_count = count( $clients_images );
				$items_count  = $items_option_value;
				$image_number = $index + 1;

				// Define column width.
				$column_width = 12 / min( $items_count, $images_count - ( $items_count * intval( $index / $items_count ) ) );

				// Supplement the HTML layout of the client item.
				$client_item = '<div class="col-md-' . esc_attr( $column_width ) . '">' . $client_item . '</div>';

				/**
				 * Check that the current image is the last in the row
				 * and not the last in the general list.
				 */
				if ( $image_number % $items_count == 0 && $image_number != $images_count ) {

					/**
					 * Supplement the HTML layout of the client item
					 * with the end of the current line and start a new one.
					 */
					$client_item .= '</div><div class="row clients-row">';
				}

				// Supplement the HTML layout of the set of clients.
				$clients_items .= $client_item;
			}
		}

		// Selected carousel type.
		if ( $clients_block_type == 'carousel' ) {

			// Define items count attribute value.
			$items_count_attr = esc_attr( '{&quot;items&quot;:&quot;' . $items_option_value . '&quot;}' );

			// Define the HTML layout of the clients block.
			$clients_block_layout =
			'<div class="owl-carousel clients-carousel" data-carousel-options="' . $items_count_attr . '">' .
				$clients_items .
			'</div>';

		// Selected grid type.
		} elseif ( $clients_block_type == 'grid' ) {

			// Define the HTML layout of the clients block.
			$clients_block_layout =
			'<div class="row clients-row">' .
				$clients_items .
			'</div>';
		}
	}
}

// Output the HTML layout of the clients block.
echo $clients_block_layout;

?>
