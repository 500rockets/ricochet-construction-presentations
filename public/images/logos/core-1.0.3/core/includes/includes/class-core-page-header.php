<?php

/**
 * Generates the configuration of the page header.
 *
 * Some actions taken when installed and activated the Unyson plugin.
 * @link https://github.com/ThemeFuse/Unyson
 */
final class Core_Page_Header {

	/**
	 * Instance of the class.
	 *
	 * @var self
	 */
	private static $instance;



	/**
	 * Display state of the page header.
	 *
	 * @var string
	 */
	private $display;



	/**
	 * Page header type.
	 *
	 * @var string
	 */
	private $type;



	/**
	 * Customizer option name or post option name created
	 * using the Unyson Framework.
	 *
	 * Only matters if the framework is installed and activated.
	 * @link https://github.com/ThemeFuse/Unyson
	 *
	 * @var string
	 */
	private $option;



	/**
	 * Contents of the page header.
	 *
	 * @var array
	 */
	private $contents = array();



	/**
	 * Properties of the page header.
	 *
	 * @var array
	 */
	private $properties = array();



	/**
	 * Constructor.
	 *
	 * @see _set_initial_properties()
	 */
	private function __construct() {

		// Setting initial properties.
		$this->_set_initial_properties();

		// Check whether to show the page header.
		if ( $this->display == 'show' ) {

			// Setting default page header contents.
			$this->contents['title'] = $this->get_page_title();

			// Action taken when installed and activated the Unyson plugin.
			if ( defined( 'FW' ) && ! empty( $this->option ) ) {

				// Define page header option value.
				$option_value = $this->_get_framework_option_value();

				// Set the key path to the type of the page header in the array of option values.
				$type_key_path = 'display/show/page_header_type/' . $this->type;

				// Slider type of the page header.
				if ( $this->type == 'slider' ) {

					// Define slides header option value.
					$slides_option_value = fw_akg( $type_key_path . '/slides', $option_value );

					// Check if the option has some value.
					if ( is_array( $slides_option_value ) && ! empty( $slides_option_value ) ) {

						// Clear the contents of the page header.
						$this->contents = array();

						// Processing options values of the each slide.
						foreach ( $slides_option_value as $slide_options_values ) {

							// Set the content in accordance with the options values.
							$this->contents[] = $this->_get_page_header_contents( $slide_options_values );

							// Set the properties in accordance with the options values.
							$this->properties[] = $this->_get_page_header_properties( $slide_options_values );
						}
					}

				// Other type of the page header.
				} else {

					// Define current type options values.
					$type_options_values = fw_akg( $type_key_path, $option_value );

					// Set the content in accordance with the options values.
					$this->contents = array_merge( $this->contents, $this->_get_page_header_contents( $type_options_values ) );

					// Set the properties in accordance with the options values.
					$this->properties = array_merge( $this->properties, $this->_get_page_header_properties( $type_options_values ) );
				}
			}
		}
	}



	/**
	 * @internal
	 *
	 * Setting initial properties.
	 * Defines the display state and type of the page header.
	 *
	 * @see _set_framework_option_name()
	 * @see _get_framework_option_value()
	 */
	private function _set_initial_properties() {

		// Set the display state of the page header.
		$this->display = ( $this->get_page_title() ) ? 'show' : 'hide';

		// Check whether to show the page header.
		if ( $this->display == 'show' ) {

			// Set the default type of the page header.
			$this->type = 'simple';
		}

		// Setting framework option name.
		$this->_set_framework_option_name();

		// Action taken when installed and activated the Unyson plugin.
		if ( defined( 'FW' ) && ! empty( $this->option ) ) {

			// Define page header option value.
			$option_value = $this->_get_framework_option_value();

			// Check if the option has some value.
			if ( ! empty( $option_value ) ) {

				// Set the display state of the page header.
				$this->display = fw_akg( 'display/display_choice', $option_value );

				// Check whether to show the page header.
				if ( $this->display == 'show' ) {

					// Set the type of the page header.
					$this->type = fw_akg( 'display/show/page_header_type/type_choice', $option_value );
				}
			}
		}
	}



	/**
	 * @internal
	 *
	 * Setting name of the option created using the Unyson Framework.
	 *
	 * Only matters if the framework is installed and activated.
	 * @link https://github.com/ThemeFuse/Unyson
	 */
	private function _set_framework_option_name() {

		// Current page is a latest blog posts page.
		if ( is_home() ) {

			$this->option = 'blog_header';

		} elseif ( is_post_type_archive( _core_get_portfolio_post_type_name() ) ) {

			$this->option = 'portfolio_header';

		// Current page is a regular page.
		} elseif ( is_page() ) {

			$this->option = 'page_header';

		// Current page is a single blog post page.
		} elseif ( is_single() && get_post_type( get_the_ID() ) === 'post' ) {

			$this->option = 'post_header';

		// Current page is a single portfolio project page.
		} elseif( is_single() && get_post_type( get_the_ID() ) === _core_get_portfolio_post_type_name() ) {

			$this->option = 'project_header';
		}
	}



	/**
	 * @internal
	 *
	 * Returns the value of the option created using the Unyson Framework.
	 *
	 * Only matters when installed and activated the Unyson plugin.
	 * @link https://github.com/ThemeFuse/Unyson
	 *
	 * @return array Framework option value.
	 */
	private function _get_framework_option_value() {

		// Specifying the initial settings.
		$option_value = '';

		// Action taken when installed and activated the Unyson plugin.
		if ( defined( 'FW' ) && ! empty( $this->option ) ) {

			// Current page is a regular page or an any single post type page.
			if ( is_single() || is_page() ) {

				// Define page header option value from post option.
				$option_value = fw_get_db_post_option( get_the_ID(), $this->option );

			// Current page is a some other type page.
			} else {

				// Define page header option value from customizer.
				$option_value = fw_get_db_customizer_option( $this->option );
			}
		}

		// Return framework option value.
		return $option_value;
	}



	/**
	 * Processes framework options values and generates page header content.
	 *
	 * Only matters when installed and activated the Unyson plugin.
	 * @link https://github.com/ThemeFuse/Unyson
	 *
	 * @param array $options_values Array of framework options values.
	 *
	 * @return array Contents of the page header.
	 */
	private function _get_page_header_contents( $options_values = array() ) {

		// Specifying the initial settings.
		$contents = array();

		// Check if option values is defined.
		if ( ! empty( $options_values ) ) {

			// Start processed of the title option.
			$title_option_value = fw_akg( 'title', $options_values );

			// Check if title option is defined.
			if ( isset( $title_option_value ) && ! empty( $title_option_value ) ) {

				// Specifying the initial settings.
				$titles  = '';
				$indents = $this->_get_page_titles_indents( $title_option_value );

				// Processing properties of the each title.
				foreach ( $title_option_value as $title_id => $title_properties ) {

					// Define text and size of the title.
					$title_text = esc_html( $title_properties['text'] );
					$title_size = esc_attr( $title_properties['size'] );

					// Check if text of title is defined.
					if ( ! empty( $title_text ) ) {

						// Check if there is a separator in the string.
						if ( strpos( $title_text, '[~]' ) !== false ) {

							// Modifying string for animating.
							$title_text	= '<span class="rotate">' . str_replace( '[~]', '|', $title_text ) . '</span>';
						}

						// Supplement the set of titles.
						$titles .= $this->_get_page_title_layout( $title_text, array( $title_size, $indents[ $title_id ] ) );
					}
				}

				// Check if set of titles is defined.
				if ( ! empty( $titles ) ) {

					// Set page header title.
					$contents['title'] = $titles;
				}
			}

			// Start processed of the subtitle option.
			$subtitle_option_value = fw_akg( 'subtitle', $options_values );

			// Check if subtitle option is defined.
			if ( isset( $subtitle_option_value ) && ! empty( $subtitle_option_value ) ) {

				// Define text of the subtitle.
				$subtitle_text = esc_html( $subtitle_option_value );

				// Check if text of subtitle is defined.
				if ( ! empty( $subtitle_text ) ) {

					// Check if there is a separator in the string.
					if ( strpos( $subtitle_text, '[~]' ) !== false ) {

						// Modifying string for animating.
						$subtitle_text = '<span class="rotate">' . str_replace( '[~]', '|', $subtitle_text ) . '</span>';
					}

					/**
					 * Define indents for page header subtitle.
					 *
					 * @since 1.0.1
					 */
					$indents = implode( ' ', array( ( $this->type == 'simple' ) ? 'm-t-5' : 'm-t-20', 'm-b-0' ) );

					// Set page header subtitle.
					$contents['subtitle'] = '<p class="' . $indents . '">' . $subtitle_text . '</p>';
				}
			}

			// Start processed of the button option.
			$button_option_value = fw_akg( 'button', $options_values );

			// Check if button option is defined.
			if ( isset( $button_option_value ) && ! empty( $button_option_value ) ) {

				// Specifying the initial settings.
				$buttons = '';

				// Processing properties of the each button.
				foreach ( $button_option_value as $button_properties ) {

					// Supplement the set of buttons.
					$buttons .= _core_get_link_layout( $button_properties );
				}

				// Check if set of buttons is defined.
				if ( ! empty( $buttons ) ) {

					// Set page header buttons.
					$contents['button'] = '<p class="m-t-30 m-b-0">' . $buttons . '</p>';
				}
			}
		}

		// Return contents of the page header.
		return $contents;
	}



	/**
	 * Processes option framework values and generates page header properties.
	 *
	 * Only matters when installed and activated the Unyson plugin.
	 * @link https://github.com/ThemeFuse/Unyson
	 *
	 * @param array $options_values Array of framework options values.
	 *
	 * @return array Properties of the page header.
	 */
	private function _get_page_header_properties( $options_values = array() ) {

		// Specifying the initial settings.
		$properties = array();

		// Check if option values is defined.
		if ( ! empty( $options_values ) ) {

			// Specifying the initial settings.
			$styles = array();

			// Start processed of the size option.
			$size_option_value = fw_akg( 'size', $options_values );

			// Check if size option is defined.
			if ( isset( $size_option_value ) && ! empty( $size_option_value ) ) {

				// Supplement the set of styles.
				$styles[] = $size_option_value;
			}

			// Start processed of the background option.
			$background_option_value = fw_akg( 'background', $options_values );

			// Check if background option is defined.
			if ( isset( $background_option_value ) && ! empty( $background_option_value ) ) {

				// Check the type of the background.
				$background_type = fw_akg( 'background_type', $background_option_value );

				// Check if selected media type of background.
				if ( $background_type == 'media_background' ) {

					// Standard type of the page header.
					if ( $this->type == 'standard' ) {

						// Define thumbnail URL.
						$thumbnail_url = esc_url( get_the_post_thumbnail_url() );

						// Check if thumbnail URL is defined.
						if ( ! empty( $thumbnail_url ) ) {

							// Set page header image.
							$properties['image'] = $thumbnail_url;
						}
					}

					// Start processed of the image option.
					$image_option_value = fw_akg( $background_type . '/image', $background_option_value );

					// Check if image option is defined.
					if ( isset( $image_option_value ) && ! empty( $image_option_value ) ) {

						// Define image URL.
						$image_url = esc_url( fw_akg( 'data/icon', $image_option_value ) );

						// Check if image URL is defined.
						if ( ! empty( $image_url ) ) {

							// Set page header image.
							$properties['image'] = $image_url;
						}
					}

					// Start processed of the video option.
					$video_option_value = fw_akg( $background_type . '/video', $background_option_value );

					// Check if video option is defined.
					if ( isset( $video_option_value ) && ! empty( $video_option_value ) ) {

						// Define video URL.
						$video_url = esc_url( $video_option_value );

						// Check if video URL is defined.
						if ( ! empty( $video_url ) ) {

							// Set page header video.
							$properties['video'] = $video_url;
						}
					}

					// Check the need for define background style effects.
					if ( isset( $properties['image'] ) || isset( $properties['video'] ) ) {

						// Standard type of the page header.
						if ( $this->type == 'standard' ) {

							// Supplement the set of styles.
							$styles[] = 'parallax';
						}

						// Start processed of the style option.
						$style_option_value = fw_akg( $background_type . '/style', $background_option_value );

						// Check if style option is defined.
						if ( isset( $style_option_value ) && ! empty( $style_option_value ) ) {

							// Check the type of the style.
							$style_type = fw_akg( 'style_type', $style_option_value );

							// Check if selected gradient type of style.
							if ( $style_type == 'gradient' ) {

								// Supplement the set of styles.
								$styles[] = 'bg-dark';
								$styles[] = 'bg-gradient';

							// Selected standard type of style.
							} elseif ( $style_type == 'standard' ) {

								// Define shade style.
								$shade_style = fw_akg( $style_type . '/shade', $style_option_value );

								// Define shade opacity.
								$shade_opacity = fw_akg( $style_type . '/opacity', $style_option_value );

								// Supplement the set of styles.
								$styles[] = $shade_style;
								$styles[] = $shade_style . '-' . $shade_opacity;
							}
						}
					}
				}
			}

			// Check if set of styles is defined.
			if ( ! empty( $styles ) ) {

				// Set page header styles.
				$properties['styles'] = array_unique( $styles );
			}
		}

		// Return properties of the page header.
		return $properties;
	}



	/**
	 * Getting page title.
	 *
	 * @return string Page title.
	 */
	private function get_page_title() {

		// Specifying the initial settings.
		$page_title = '';

		// Current page is a regular page or an any single post type page.
		if ( is_single() || is_page() ) {

			$page_title = get_the_title();

		// Current page is a post type archive page.
		} elseif ( is_post_type_archive() ) {

			$page_title = post_type_archive_title( '', false );

		// Current page is a category page, tag page or any custom taxonomy term page.
		} elseif ( is_category() || is_tag() || is_tax() ) {

			$page_title = single_term_title( '', false );

		// Current page is any other archive page.
		} elseif ( is_archive() ) {

			$page_title = get_the_archive_title();

		// Current page is a search results page.
		} elseif ( is_search() ) {

			$page_title = __( 'Search results for', 'core' ) . '&#58; ' . get_search_query();

		// Current page is a 404 page.
		} elseif ( is_404() ) {

			$page_title = __( 'Page not found', 'core' );

		// Current page is a some other type page.
		} else {

			$page_title = get_bloginfo( 'name', 'display' );
		}

		// Define title classes.
		$classes = array( ( $this->type == 'simple' ) ? 'h5' : 'h3' );

		// Return page title.
		return $this->_get_page_title_layout( $page_title, $classes );
	}



	/**
	 * @internal
	 *
	 * Get page title HTML layout.
	 *
	 * @param string $title   Page title.
	 * @param array  $classes Title classes.
	 *
	 * @return string HTML layout of the page header title.
	 */
	private function _get_page_title_layout( $title = '', $classes = array() ) {

		// Specifying the initial settings.
		$title_layout = '';

		// Check if title is defined.
		if ( ! empty( $title ) ) {

			// Define title classes.
			$attributes = core_attr_to_html( array( 'class' => $classes ) );

			// Define HTML layout of the page header title.
			$title_layout = '<h1 ' . $attributes . '>' . $title . '</h1>';
		}

		// Return HTML layout of the page header title.
		return $title_layout;
	}



	/**
	 * @internal
	 *
	 * Get indents of titles configured with Unison Framework.
	 *
	 * Only matters if the framework is installed and activated.
	 * @link https://github.com/ThemeFuse/Unyson
	 *
	 * @param array $title_option_value Customizer option value or post option
	 *                                  value created using the Unyson Framework.
	 *
	 * @return array Page header titles indents.
	 */
	private function _get_page_titles_indents( $title_option_value = array() ) {

		// Specifying the initial settings.
		$titles_indents        = array();
		$indents_configuration = array(
			'h1' => '0',
			'h2' => '0',
			'h3' => '0',
			'h4' => '10',
			'h5' => '15',
			'h6' => '20',
		);

		// Check if title option is not empty.
		if ( ! empty( $title_option_value ) ) {

			// Processing properties of the each title.
			foreach ( $title_option_value as $title_id => $current ) {

				// Check if the current item hasn't the previous.
				if ( ! isset( $previous ) ) {

					// Set indent for current title.
					$titles_indents[ $title_id ] = '0';

				// Current item has the previous.
				} else {

					// Define indents for previous and current items from configuration.
					$previous_indents = $indents_configuration[ $previous['size'] ];
					$current_indents  = $indents_configuration[ $current['size'] ];

					// Set indent for current title.
					$titles_indents[ $title_id ] = max( $previous_indents, $current_indents );
				}

				// Convert indent to CSS class.
				$titles_indents[ $title_id ] = 'm-t-' . $titles_indents[ $title_id ];

				// Define current item as previous.
				$previous = $current;
			}
		}

		// Return titles indents.
		return $titles_indents;
	}



	/**
	 * Get configuration of the page header.
	 *
	 * @return array Page header configuration.
	 */
	public function page_header_configuration() {

		// Return configuration of the page header.
		return array(
			'display'    => $this->display,
			'type'       => $this->type,
			'contents'   => $this->contents,
			'properties' => $this->properties,
		);
	}



	/**
	 * Returns the singleton instance of the class.
	 *
	 * @return Core_Page_Header[] Instance of the class.
	 */
	public static function get_instance() {

		// Instance is not defined.
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			// Create new instance.
			self::$instance = new self();
		}

		// Return instance of the class.
		return self::$instance;
	}
}

?>
