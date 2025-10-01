<?php

/**
 * Displays page header.
 *
 * @uses Core_Page_Header[]
 */
function core_get_page_header() {

	// Specifying the initial settings.
	$page_header_layout = '';

	// Check if class exists.
	if ( class_exists( 'Core_Page_Header' ) ) {

		// Get configuration of the page header.
		$configuration = Core_Page_Header::get_instance()->page_header_configuration();

		// Specifying the initial settings.
		extract( $configuration );

		// Check whether to show the page header.
		if ( $display == 'show' ) {

			// Define HTML layout of the breadcrumbs.
			$breadcrumbs = ( ! is_front_page() && ! is_search() ) ? core_get_breadcrumbs() : '';

			// Simple type of the page header.
			if ( $type == 'simple' ) {

				// Specifying the initial settings.
				$contents = implode( '', $contents );

				// Define HTML layout of the page header.
				$page_header_layout =
				'<section class="module-page-title">' .
					'<div class="container">' .
						'<div class="row-page-title">' .
							'<div class="page-title-captions">' .
								$contents .
							'</div>' .
							'<div class="page-title-secondary">' .
								$breadcrumbs .
							'</div>' .
						'</div>' .
					'</div>' .
				'</section>';

			// Standard type of the page header.
			} elseif ( $type == 'standard' ) {

				// Specifying the initial settings.
				$contents   = implode( '', $contents );
				$attributes = array( 'class' => array( 'module-header' ) );

				// Check if styles is defined.
				if ( isset( $properties['styles'] ) ) {

					// Check if styles is not empty.
					if ( ! empty( $properties['styles'] ) ) {

						// Supplement the set of classes.
						$attributes['class'] = array_merge( $attributes['class'], $properties['styles'] );
					}
				}

				// Check if image is defined.
				if ( isset( $properties['image'] ) ) {

					// Check if image is not empty.
					if ( ! empty( $properties['image'] ) ) {

						// Set image background attribute.
						$attributes['data-background'] = $properties['image'];
					}
				}

				// Check if video is defined.
				if ( isset( $properties['video'] ) ) {

					// Check if video is not empty.
					if ( ! empty( $properties['video'] ) ) {

						// Set video background attribute.
						$attributes['data-jarallax-video'] = $properties['video'];
					}
				}

				// Convert the attributes to string.
				$attributes = core_attr_to_html( $attributes );

				// Define HTML layout of the page header.
				$page_header_layout =
				'<section ' . $attributes . '>' .
					'<div class="container">' .
						'<div class="row">' .
							'<div class="col-md-12">' .
								$contents .
							'</div>' .
						'</div>' .
					'</div>' .
				'</section>';

			// Slider type of the page header.
			} elseif ( $type == 'slider' ) {

				// Specifying the initial settings.
				$page_header_slides = '';

				// Processing contents of the each slide.
				foreach ( $contents as $slide_number => $slide_contents ) {

					// Specifying the initial settings.
					$contents   = implode( '', $slide_contents );
					$attributes = array( 'class' => array() );
					$image      = '';

					// Check if styles is defined.
					if ( isset( $properties[ $slide_number ]['styles'] ) ) {

						// Check if styles is not empty.
						if ( ! empty( $properties[ $slide_number ]['styles'] ) ) {

							// Supplement the set of classes.
							$attributes['class'] = array_merge( $attributes['class'], $properties[ $slide_number ]['styles'] );
						}
					}

					// Check if image is defined.
					if ( isset( $properties[ $slide_number ]['image'] ) ) {

						// Check if image is not empty.
						if ( ! empty( $properties[ $slide_number ]['image'] ) ) {

							// Define the HTML layout of the image.
							$image = '<img src="' . $properties[ $slide_number ]['image'] . '" alt="">';
						}
					}

					// Convert the attributes to string.
					$attributes = core_attr_to_html( $attributes );

					// Supplement the HTML layout of the page header slides.
					$page_header_slides .=
					'<li ' . $attributes . '>' . $image .
						'<div class="container">' .
							'<div class="row">' .
								'<div class="col-md-12">' .
									$contents .
								'</div>' .
							'</div>' .
						'</div>' .
					'</li>';
				}

				// Define HTML layout of the page header.
				$page_header_layout =
				'<section class="module-slides module-gray">' .
					'<ul class="slides-container">' .
						$page_header_slides .
					'</ul>' .
					'<nav class="slides-navigation">' .
						'<a class="next" href="#"><span class="arrows arrows-arrows-slim-right"></span></a>' .
						'<a class="prev" href="#"><span class="arrows arrows-arrows-slim-left"></span></a>' .
					'</nav>' .
				'</section>';
			}
		}
	}

	// Output the HTML layout of the the page header.
	echo $page_header_layout;
}



/**
 * Return breadcrumbs HTML layout.
 *
 * Only matters when installed and activated the Unyson plugin and breadcrumbs extension.
 * @link https://github.com/ThemeFuse/Unyson
 *
 * @see core_extension_is_active()
 *
 * @return string breadcrumbs HTML layout.
 */
function core_get_breadcrumbs() {
	if ( core_extension_is_active( 'breadcrumbs' ) ) {
		return fw_ext_get_breadcrumbs( '' );
	}
}



/**
 * Check if Unyson extension is active.
 * Uses the internal method of the extension class.
 *
 * Some actions taken when installed and activated the Unyson plugin.
 * @link https://github.com/ThemeFuse/Unyson
 *
 * @param string $extension_name Extension name.
 *
 * @return bool True if extension is active.
 */
function core_extension_is_active( $extension_name = null ) {
	if ( $extension_name ) {
		return defined( 'FW' ) && fw_ext( $extension_name );
	} else {
		return false;
	}
}



/**
 * Check whether a post was built with the page builder.
 *
 * Only matters when installed and activated the Unyson plugin.
 * @link https://github.com/ThemeFuse/Unyson
 *
 * @see core_extension_is_active()
 *
 * @return boolean Whether a post was built with the page builder.
 */
function core_is_builder_post() {
	$is_builder_post = false;
	if ( core_extension_is_active( 'page-builder' ) ) {
		$is_builder_post = fw_ext_page_builder_is_builder_post( get_the_ID() );
	}
	return $is_builder_post;
}



/**
 * @internal
 *
 * Getting post type name of the Unyson portfolio extension.
 * @link https://github.com/ThemeFuse/Unyson
 *
 * @return string Post type name.
 */
function _core_get_portfolio_post_type_name() {
	$post_type_name = '';
	if ( core_extension_is_active( 'portfolio' ) ) {
		$post_type_name = fw()->extensions->get( 'portfolio' )->get_post_type_name();
	}
	return $post_type_name;
}



/**
 * @internal
 *
 * Getting taxonomy name of the Unyson portfolio extension.
 * @link https://github.com/ThemeFuse/Unyson
 *
 * @return string Taxonomy name.
 */
function _core_get_portfolio_taxonomy_name() {
	$taxonomy_name = '';
	if ( core_extension_is_active( 'portfolio' ) ) {
		$taxonomy_name = fw()->extensions->get( 'portfolio' )->get_taxonomy_name();
	}
	return $taxonomy_name;
}



/**
 * @internal
 *
 * Generates a link layout.
 *
 * Only matters when installed and activated the Unyson plugin.
 * @link https://github.com/ThemeFuse/Unyson
 *
 * @param array $options Set of link options.
 *
 * @return string HTML layout of a link.
 */
function _core_get_link_layout( $options = array() ) {

	// Specifying the initial settings.
	$link_layout = '';

	// Check if the options has some values.
	if ( ! empty( $options ) ) {

		// Define attributes.
		$attributes = array(
			'target' => esc_attr( $options['target'] ),
		);

		// Define link label.
		$link_label = esc_html( $options['label'] );

		// Define link URL.
		$url_type = fw_akg( 'url_type/type_choice', $options );

		// Selected custom type.
		if ( $url_type == 'custom' ) {

			$link_url = esc_url( fw_akg( 'url_type/custom/url', $options ) );
			if ( empty( $link_label ) ) {
				$link_label = esc_html( fw_akg( 'url_type/custom/url', $options ) );
			}

		// Selected internal type.
		} else {

			$source_id  = fw_akg( 'url_type/' . $url_type . '/source_id/0', $options, '' );
			$link_url   = ( ! empty( $source_id ) ) ? esc_url( get_permalink( $source_id ) ) : '';
			if ( empty( $link_label ) && ! empty( $source_id ) ) {
				$link_label = esc_html( get_the_title( $source_id ) );
			}
		}

		// Supplement the set of attributes.
		if ( ! empty( $link_url ) ) { $attributes['href'] = $link_url; }

		// Define styles.
		$styles = _core_get_button_styles( $options );

		// Supplement the set of attributes.
		if ( ! empty( $styles ) ) { $attributes['class'] = $styles; }

		// Convert the attributes to string.
		$attributes = core_attr_to_html( $attributes );

		// Define the HTML layout of the link.
		$link_layout = '<a ' .$attributes . '>' . $link_label . '</a>';
	}

	// Return the HTML layout of the link.
	return $link_layout;
}



/**
 * @internal
 *
 * Generates a button styles.
 *
 * Only matters when installed and activated the Unyson plugin.
 * @link https://github.com/ThemeFuse/Unyson
 *
 * @param array $options Set of button options.
 *
 * @return array Set of button classes.
 */
function _core_get_button_styles( $options = array() ) {

	// Specifying the initial settings.
	$classes = array();

	// Check if the options has some values.
	if ( ! empty( $options ) ) {

		// Define button style settings.
		$classes = array_filter( array(
			fw_akg( 'size', $options ),
			fw_akg( 'rounding', $options ),
			fw_akg( 'color', $options ),
			implode( ' ', array_keys( fw_akg( 'style', $options, array() ) ) ),
		) );

		// Add an additional class.
		if ( ! empty( $classes ) ) {
			$classes = array_merge( array( 'btn' ), $classes );
		}
	}

	// Return button classes.
	return $classes;
}



/**
 * @internal
 *
 * Returns the color from the option value.
 * If the value is missing, returns default color.
 *
 * Only matters when installed and activated the Unyson plugin.
 * @link https://github.com/ThemeFuse/Unyson
 *
 * @return string Color in HEX format.
 */
function _core_get_brand_color() {

	// Specifying the initial settings.
	$brand_color = '#000';

	// Action taken when installed and activated the Unyson plugin.
	if ( defined( 'FW' ) ) {

		// Define brand color from option.
		$color_option_value = fw_get_db_customizer_option( 'brand_color' );

		// Check if the option has some value.
		if ( ! empty( $color_option_value ) ) { $brand_color = $color_option_value; }
	}

	// Return brand color.
	return apply_filters( 'core_brand_color', $brand_color );
}



/**
 * @internal
 *
 * Returns Google Maps API key from the option value.
 * If the value is missing, returns empty string.
 *
 * Only matters when installed and activated the Unyson plugin.
 * @link https://github.com/ThemeFuse/Unyson
 *
 * @return string Google Maps API key.
 */
function _core_get_google_maps_api_key() {

	// Specifying the initial settings.
	$google_maps_api_key = '';

	// Action taken when installed and activated the Unyson plugin.
	if ( defined( 'FW' ) ) {

		// Define brand color from option.
		$key_option_value = fw_get_db_customizer_option( 'google_maps_api_key' );

		// Check if the option has some value.
		if ( ! empty( $key_option_value ) ) { $google_maps_api_key = $key_option_value; }
	}

	// Return brand color.
	return $google_maps_api_key;
}



/**
 * @internal
 *
 * Get the content, depending on its type.
 *
 * Only matters when installed and activated the Unyson plugin.
 * @link https://github.com/ThemeFuse/Unyson
 *
 * @param array $option_value Framework option value.
 *
 * @return string Content.
 */
function _core_get_special_typed_content( $option_value = array() ) {

	// Specifying the initial settings.
	$item_content = '';

	// Check if the option has some value.
	if ( ! empty( $option_value ) ) {

		// Check the type of item.
		$item_type = fw_akg( 'type_choice', $option_value );

		// Selected text type.
		if ( $item_type == 'text' ) {

			// Define the HTML layout of the item.
			$item_content = esc_html( fw_akg( 'text/content', $option_value ) );

		// Selected link type.
		} elseif ( $item_type == 'link' ) {

			// Define link settings.
			$link_options = fw_akg( 'link', $option_value );

			// Define the HTML layout of the item.
			$item_content = _core_get_link_layout( $link_options );

		// Selected e-mail type.
		} elseif ( $item_type == 'email' ) {

			$email_address = esc_html( fw_akg( 'email/address', $option_value ) );

			if ( is_email( $email_address ) ) {

				// Define the HTML layout of the item.
				$item_content = '<a href="mailto:' . $email_address . '">' . $email_address. '</a>';
			}
		}
	}

	// Return content.
	return $item_content;
}



/**
 * Generate attributes string for HTML tag.
 *
 * @param array $attr_array Array of attributes where the
 *                          key is the name of the attribute.
 *
 * @return string HTML tag attributes.
 */
function core_attr_to_html( $attr_array = array() ) {

	// Specifying the initial settings.
	$attributes = '';

	// Check parameter type.
	if ( is_array( $attr_array ) ) {

		// Processing an array of attributes.
		foreach ( $attr_array as $attr_name => $attr_val ) {
			if ( is_array( $attr_val ) ) {
				$attr_val = implode( ' ', array_filter( $attr_val ) );
			}
			$attributes .= $attr_name . '="' . htmlspecialchars( $attr_val ) . '" ';
		}
	}

	// Return HTML attributes.
	return trim( $attributes );
}



/**
 * Formats a string for adding to page inline styles.
 *
 * @param string $styles String contained CSS styles.
 *
 * @return string Formatted string.
 */
function core_prepare_inline_styles( $styles ) {

	// Return prepared string.
	return preg_replace( '/\t/', '', str_replace( array( "\r\n", "\r", "\n" ), ' ', $styles ) );
}



/**
 * @internal
 *
 * Adds a prefix to array keys.
 *
 * @param array  $array  Input array.
 * @param string $prefix The string to be added as a prefix to the keys.
 *
 * @return array Array with prefixed keys.
 */
function _core_array_key_prefix( $array = array(), $prefix = '' ) {
	if ( is_array( $array ) && is_string( $prefix ) && ! empty( $prefix ) ) {
		foreach ( $array as $key => $value ) {
			$array[ $prefix . $key ] = $value;
			unset( $array[ $key ] );
		}
	}
	return $array;
}



/**
 * @internal
 *
 * Returns the set of options, depending on the configuration name.
 * Necessary when the same set of options used for different functionality.
 *
 * Only matters when installed and activated the Unyson plugin.
 * @link https://github.com/ThemeFuse/Unyson
 *
 * @uses FW_Cache[]
 *
 * @param string $name The name of the configuration you want to get.
 *
 * @return array Set of options.
 */
function _core_get_options_config( $name = '' ) {

	// Define cache key to store current option template.
	$cache_key = 'core_cache_root/options_templates/' . $name;

	try {

		// Return current option template from cache.
		return FW_Cache::get( $cache_key );

	} catch ( FW_Cache_Not_Found_Exception $e ) {

		// Set default configuration value.
		$template = array();

		// Define path to options template file.
		$file_path = get_template_directory() . '/includes/options/templates/' . $name . '.php';

		if ( file_exists( $file_path ) ) {

			// Extract variable from file.
			$template = fw_akg( 'options', fw_get_variables_from_file(

				// Path to options template file.
				$file_path,

				// Extracted variable with default value.
				array( 'options' => array() )
			) );
		}

		// Save current option template to cache.
		FW_Cache::set( $cache_key, $template );

		// Return the option template.
		return $template;
	}
}

?>
