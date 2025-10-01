<?php

/**
 * @internal
 *
 * Get fonts settings.
 *
 * Only matters when installed and activated the Unyson plugin.
 * @link https://github.com/ThemeFuse/Unyson
 *
 * @see _core_get_typography_options_values()
 *
 * @uses FW_Cache[]
 *
 * @return array All fonts settings.
 */
function _core_get_fonts_settings() {

	// Define cache key to store fonts settings.
	$cache_key = 'core_cache_root/typography/fonts_settings';

	try {

		// Return fonts settings from cache.
		return FW_Cache::get( $cache_key );

	} catch ( FW_Cache_Not_Found_Exception $e ) {

		/**
		 * Get fonts settings.
		 *
		 * @see _core_get_typography_options_values()
		 */
		$fonts_settings = _core_get_typography_options_values();

		// Save fonts settings to cache.
		FW_Cache::set( $cache_key, $fonts_settings );

		// Return fonts settings.
		return $fonts_settings;
	}
}



/**
 * @internal
 *
 * Get required google fonts from fonts settings.
 * Fonts settings are the values of the 'typography-v2' option type.
 *
 * Only matters when installed and activated the Unyson plugin.
 * @link https://github.com/ThemeFuse/Unyson
 *
 * @param array $fonts_settings   All fonts settings.
 * @param array $extra_variations An array of matches option names to set
 *                                of additional font variations.
 * @param array $default_fonts    Default fonts set.
 *
 * @return array Required font families and subsets.
 */
function _core_get_required_google_fonts( $fonts_settings = array(), $extra_variations = array(), $default_fonts = array() ) {

	// Specifying the initial settings.
	$required_fonts = array( 'families' => array(), 'subsets' => array() );
	$required_fonts = array_merge( $required_fonts, $default_fonts );

	// Check if the parameter has some value.
	if ( ! empty( $fonts_settings ) ) {

		// Specifying the initial settings.
		$families = &$required_fonts['families'];
		$subsets  = &$required_fonts['subsets'];

		// Processing of settings of each font.
		foreach ( $fonts_settings as $option_name => $font_configuration ) {

			// Perform processing only if a google font is selected.
			if ( $font_configuration['google_font'] ) {

				// Add font subsets.
				$subsets = array_unique( array_merge( $subsets, $font_configuration['subsets'] ) );

				// Add a font to the common set if it does not already exist.
				$font_name = $font_configuration['family'];
				if ( ! isset( $families[ $font_name ] ) ) {
					$families[ $font_name ] = array();
				}

				// Set font variation.
				$current_variations = array( $font_configuration['variation'] );

				// Processing rules for adding extra variations.
				if ( ! empty( $extra_variations[ $option_name ] ) ) {

					// Add specified font variations.
					if ( is_array( $extra_variations[ $option_name ] ) ) {
						$additional_variations = array_intersect( $extra_variations[ $option_name ], $font_configuration['variations'] );
						$current_variations    = array_merge( $current_variations, $additional_variations );

					// Add all font variations.
					} elseif ( $extra_variations[ $option_name ] === true ) {
						$current_variations = $font_configuration['variations'];
					}
				}

				// Add data to a common set.
				$families[ $font_name ] = array_unique( array_merge( $families[ $font_name ], $current_variations ) );
			}
		}
	}

	// Return required font family and subsets.
	return $required_fonts;
}



/**
 * @internal
 *
 * Get inline fonts styles using fonts settings.
 * Fonts settings are the values of the 'typography-v2' option type.
 *
 * Only matters when installed and activated the Unyson plugin.
 * @link https://github.com/ThemeFuse/Unyson
 *
 * @param array $fonts_settings     All fonts settings.
 * @param array $style_elements     An array of matches option names
 *                                  to HTML elements.
 * @param array $exclude_components An array of matches option names to style components.
 *                                  Used to restrict style components.
 *
 * @return string The set of styles.
 */
function _core_get_inline_fonts_styles( $fonts_settings = array(), $style_elements = array(), $exclude_components = array() ) {

	// Specifying the initial settings.
	$inline_styles = array();

	// Check if the parameters has some values.
	if ( ! empty( $fonts_settings ) && ! empty( $style_elements ) ) {

		// Define formats of CSS styles.
		$style_formats = array(
			'family'         => 'font-family: %s;',
			'style'          => 'font-style: %s;',
			'weight'         => 'font-weight: %s;',
			'size'           => 'font-size: %spx;',
			'color'          => 'color: %s;',
			'letter-spacing' => 'letter-spacing: %spx',
		);

		// Processing of settings of each font.
		foreach ( $fonts_settings as $option_name => $font_configuration ) {

			// Check if the required elements is defined.
			if ( ! empty( $style_elements[ $option_name ] ) ) {

				// Define element configuration depending on the style formats.
				$element_configuration = array();
				foreach ( $style_formats as $style_component => $style_format ) {
					if ( ! empty( $font_configuration[ $style_component ] ) ) {

						// Check if there are restrictions on style components.
						$excluded_component = false;
						if ( ! empty( $exclude_components[ $option_name ] ) ) {
							if ( in_array( $style_component, $exclude_components[ $option_name ] ) ) {
								$excluded_component = true;
							}
						}

						// Supplement the set of element configuration.
						if ( ! $excluded_component ) {
							$element_configuration[] = sprintf( $style_format, esc_html( $font_configuration[ $style_component ] ) );
						}
					}
				}

				// Supplement the set of inline styles.
				if ( ! empty( $element_configuration ) ) {
					$inline_styles[] = implode( ', ', $style_elements[ $option_name ] ) . ' { ' . implode( ' ', $element_configuration ) . ' }';
				}
			}
		}
	}

	// Return styles.
	return implode( ' ', $inline_styles );
}



/**
 * @internal
 *
 * Get typography options values from customizer.
 * Searching options of 'typography-v2' type.
 *
 * Only matters when installed and activated the Unyson plugin.
 * @link https://github.com/ThemeFuse/Unyson
 *
 * @see _core_update_font_settings()
 *
 * @param array $options_array Contains a set of option values that will be
 *                             checked for the presence of a specific type of
 *                             option.
 * @param array $option_depth  Contains tree up to the last processed
 *                             non-container option.
 *
 * @return array All typography options values.
 */
function _core_get_typography_options_values( $options_array = array(), $option_depth = array() ) {

	// Define the initial set of options.
	if ( empty( $options_array ) ) {
		$customizer_options = fw()->theme->get_customizer_options();
		$options_array = fw_extract_only_options( $customizer_options );
	}

	// Specifying the initial settings.
	$option_type        = 'typography-v2';
	$options_values     = array();
	$options_containers = array(
		'tab'   => 'options',
		'popup' => 'popup-options',
	);

	// Processing of each option.
	foreach ( $options_array as $option_name => $option_settings ) {

		// Check if current option has type.
		if ( isset( $option_settings['type'] ) ) {

			// Supplement tree of options with the current option.
			$current_depth = array_merge( $option_depth, array( $option_name ) );

			// Check if current option has 'typography-v2' type.
			if ( $option_settings['type'] == $option_type ) {

				// Get option value from database or from default values.
				$option_value = fw_get_db_customizer_option( implode( '/', $current_depth ) );
				if ( ! empty( $option_value ) ) {
					$font_settings = $option_value;
				} else {
					$customizer_options = fw()->theme->get_customizer_options();
					$default_values     = fw_get_options_values_from_input( $customizer_options, array() );
					$font_settings      = fw_akg( implode( '/', $current_depth ), $default_values );
				}

				// Update font settings.
				$options_values[ $option_name ] = _core_update_font_settings( $font_settings );

			// Current option has other type.
			} else {

				// Specifying the initial settings.
				$internal_options = false;

				// Get the value of the internal options if the current option is a container.
				if ( in_array( $option_settings['type'], array_keys( $options_containers ) ) ) {
					$internal_options = $option_settings[ $options_containers[ $option_settings['type'] ] ];
					if ( $option_settings['type'] == 'tab' ) { array_pop( $current_depth ); }

				// Get the value of the Multi-Picker options.
				} elseif ( $option_settings['type'] == 'multi-picker' ) {
					$picker_data     = array_keys( $option_settings['picker'] );
					$picker_key_path = implode( '/', $current_depth ) . '/' . $picker_data[0];
					$picker_value    = fw_get_db_customizer_option( $picker_key_path );
					if ( ! empty( $option_settings['choices'][ $picker_value ] ) ) {
						$current_depth    = array_merge( $current_depth, array( $picker_value ) );
						$internal_options = $option_settings['choices'][ $picker_value ];
					}
				}

				// Processing of internal options.
				if ( $internal_options !== false ) {
					$options_values = array_merge( $options_values, _core_get_typography_options_values( $internal_options, $current_depth ) );
				}
			}
		}
	}

	// Return typography options values.
	return $options_values;
}



/**
 * @internal
 *
 * Adding additional data to font settings.
 *
 * Only matters when installed and activated the Unyson plugin.
 * @link https://github.com/ThemeFuse/Unyson
 *
 * @see _core_get_style_and_weight()
 * @see fw_get_google_fonts_v2()
 *
 * @uses FW_Cache[]
 *
 * @param array $font_settings Font settings from typography option value.
 *
 * @return array Modified font settings.
 */
function _core_update_font_settings( $font_settings = array() ) {

	// Check if current font is google font.
	if ( $font_settings['google_font'] ) {

		// Set style and weight.
		$font_settings = array_merge(
			$font_settings,
			_core_get_style_and_weight( $font_settings['variation'] )
		);

		// Define cache key to store google fonts.
		$cache_key = 'core_cache_root/typography/google_fonts';

		try {

			// Get google fonts from cache.
			$google_fonts = FW_Cache::get( $cache_key );

		} catch ( FW_Cache_Not_Found_Exception $e ) {

			/**
			 * Get google fonts.
			 *
			 * @see fw_get_google_fonts_v2()
			 */
			$google_fonts = json_decode( fw_get_google_fonts_v2(), true );

			// Save google fonts to cache.
			FW_Cache::set( $cache_key, $google_fonts );
		}

		// Search current font.
		foreach ( $google_fonts['items'] as $google_font ) {

			// Current font found.
			if ( $google_font['family'] === $font_settings['family'] ) {

				// Set subsets and variations.
				$font_settings['subsets']    = $google_font['subsets'];
				$font_settings['variations'] = $google_font['variants'];
			}
		}
	}

	// Return modified font settings.
	return $font_settings;
}



/**
 * @internal
 *
 * Get style and weight according to the type of variation.
 *
 * @param string $variation Variation type.
 *
 * @return array Style and weight.
 */
function _core_get_style_and_weight( $variation = '' ) {

	// Matching variations to style and weight.
	$configs = array(
		'100'       => array( 'style' => 'normal', 'weight' => '100' ),
		'100italic' => array( 'style' => 'italic', 'weight' => '100' ),
		'200'       => array( 'style' => 'normal', 'weight' => '200' ),
		'200italic' => array( 'style' => 'italic', 'weight' => '200' ),
		'300'       => array( 'style' => 'normal', 'weight' => '300' ),
		'300italic' => array( 'style' => 'italic', 'weight' => '300' ),
		'regular'   => array( 'style' => 'normal', 'weight' => '400' ),
		'italic'    => array( 'style' => 'italic', 'weight' => '400' ),
		'500'       => array( 'style' => 'normal', 'weight' => '500' ),
		'500italic' => array( 'style' => 'italic', 'weight' => '500' ),
		'600'       => array( 'style' => 'normal', 'weight' => '600' ),
		'600italic' => array( 'style' => 'italic', 'weight' => '600' ),
		'700'       => array( 'style' => 'normal', 'weight' => '700' ),
		'700italic' => array( 'style' => 'italic', 'weight' => '700' ),
		'800'       => array( 'style' => 'normal', 'weight' => '800' ),
		'800italic' => array( 'style' => 'italic', 'weight' => '800' ),
		'900'       => array( 'style' => 'normal', 'weight' => '900' ),
		'900italic' => array( 'style' => 'italic', 'weight' => '900' ),
	);

	// If configuration wasn't found, return empty array.
	if ( ! isset( $configs[ $variation ] ) ) { return array(); }

	// Return style and weight.
	return $configs[ $variation ];
}

?>
