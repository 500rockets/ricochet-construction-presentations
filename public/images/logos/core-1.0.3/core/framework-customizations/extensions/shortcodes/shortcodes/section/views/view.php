<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$section_layout = '';

$section_id     = esc_html( $atts['section_id'] );
$options_values = $atts['type'];
$section_type   = fw_akg( 'type_choice', $options_values );

// Define default contents.
$section_heading = '';

// Specifying the initial settings.
$attributes = array( 'id' => $section_id, 'class' => array() );

// Define container width.
$container_width = esc_attr( fw_akg( $section_type . '/width', $options_values ) );

// Start processed of the indents option.
$indents_type = fw_akg( $section_type . '/indents/indents_type', $options_values );

// Check if the option has some value.
if ( ! empty( $indents_type ) ) {

	// Selected custom type of indents.
	if ( $indents_type == 'custom' ) {

		// Define top and bottom indents.
		$top_indent    = esc_attr( fw_akg( $section_type . '/indents/custom/top', $options_values ) );
		$bottom_indent = esc_attr( fw_akg( $section_type . '/indents/custom/bottom', $options_values ) );

		// Supplement the set of styles.
		$attributes['class'][] = 'module';
		$attributes['class'][] = 'p-t-' . $top_indent;
		$attributes['class'][] = 'p-b-' . $bottom_indent;

	// Selected other type of indents.
	} else {

		// Supplement the set of styles.
		$attributes['class'][] = esc_attr( $indents_type );
	}
}

// Start processed of the dividers option.
$dividers = fw_akg( $section_type . '/dividers', $options_values );

// Check if the option has some value.
if ( ! empty( $dividers ) ) {

	// Supplement the set of styles.
	$attributes['class'] = array_merge( $attributes['class'], array_keys( $dividers, true ) );
}

// Selected standard section type.
if ( $section_type == 'standard' ) {

	// Specifying the initial settings.
	$section_content = '';

	// Start processed of the background option.
	$background_option_value = fw_akg( 'standard/background', $options_values );

	// Check the type of the background.
	$section_background_type = fw_akg( 'background_type', $background_option_value );

	// Selected gray background.
	if ( $section_background_type == 'gray_background' ) {

		// Supplement the set of styles.
		$attributes['class'][] = 'module-gray';

	// Selected media type of background.
	} elseif ( $section_background_type == 'media_background' ) {

		// Start processed of the image option.
		$image_option_value = fw_akg( $section_background_type . '/image', $background_option_value );

		// Define image URL.
		$image_url = esc_url( fw_akg( 'data/icon', $image_option_value ) );

		// Check if image URL is defined.
		if ( ! empty( $image_url ) ) {

			// Set page header image.
			$attributes['data-background'] = $image_url;
		}

		// Start processed of the video option.
		$video_option_value = fw_akg( $section_background_type . '/video', $background_option_value );

		// Define video URL.
		$video_url = esc_url( $video_option_value );

		// Check if video URL is defined.
		if ( ! empty( $video_url ) ) {

			// Set page header video.
			$attributes['data-jarallax-video'] = $video_url;
		}

		// Check the need for define background style effects.
		if ( isset( $attributes['data-background'] ) || isset( $attributes['data-jarallax-video'] ) ) {

			// Supplement the set of styles.
			$attributes['class'][] = 'parallax';

			// Start processed of the style option.
			$style_option_value = fw_akg( $section_background_type . '/style', $background_option_value );

			// Check the type of the style.
			$style_type = fw_akg( 'style_type', $style_option_value );

			// Check if selected gradient type of style.
			if ( $style_type == 'gradient' ) {

				// Supplement the set of styles.
				$attributes['class'][] = 'bg-dark';
				$attributes['class'][] = 'bg-gradient';

			// Selected standard type of style.
			} elseif ( $style_type == 'standard' ) {

				// Define shade style.
				$shade_style = fw_akg( $style_type . '/shade', $style_option_value );

				// Define shade opacity.
				$shade_opacity = fw_akg( $style_type . '/opacity', $style_option_value );

				// Supplement the set of styles.
				$attributes['class'][] = $shade_style;
				$attributes['class'][] = $shade_style . '-' . $shade_opacity;
			}
		}
	}

	// Check if the heading or content has some values.
	if ( ! empty( $section_heading ) || ! empty( $content ) ) {

		// Define the HTML layout of the section content.
		$section_content =
		'<div class="' . $container_width . '">' .
			$section_heading .
			do_shortcode( $content ) .
		'</div>';
	}

	// Convert the attributes to string.
	$attributes = core_attr_to_html( $attributes );

	// Define the HTML layout of the section block.
	$section_layout = '<section ' . $attributes . '>' . $section_content . '</section>';

// Selected blog section type.
} elseif ( $section_type == 'blog' ) {

	// Specifying the initial settings.
	$section_content = '';
	$blog_items      = '';

	// Define posts selection type.
	$selection_type = fw_akg( 'blog/selection/selection_type', $options_values );

	// Selected custom selection type.
	if ( $selection_type == 'custom' ) {

		// Define custom posts identifiers.
		$posts_ids = fw_akg( 'blog/selection/custom/posts_ids', $options_values );

		// Check if the option has some value.
		if ( ! empty( $posts_ids ) ) {

			// Define query arguments.
			$query_args = array(
				'post_type'      => array( 'post' ),
				'posts_per_page' => 9,
				'no_found_rows'  => true,
				'post__in'       => $posts_ids,
				'orderby'        => 'post__in',
			);
		}

	// Selected default selection type.
	} elseif ( $selection_type == 'default' ) {

		// Define selection condition.
		$condition_type = fw_akg( 'blog/selection/default/condition', $options_values );

		// Define posts count.
		$posts_count = fw_akg( 'blog/selection/default/count', $options_values );

		// Selected recent condition type.
		if ( $condition_type == 'recent' ) {

			// Define query arguments.
			$query_args = array(
				'post_type'           => array( 'post' ),
				'posts_per_page'      => $posts_count,
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
			);

		// Selected random condition type.
		} elseif ( $condition_type == 'random' ) {

			// Define query arguments.
			$query_args = array(
				'post_type'           => array( 'post' ),
				'posts_per_page'      => $posts_count,
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
				'orderby'             => 'rand',
			);
		}
	}

	// Define blog layout type.
	$layout_type = fw_akg( 'blog/layout', $options_values );

	// Check if query arguments is defined.
	if ( isset( $query_args ) && ! empty( $query_args ) ) {

		$custom_query = new WP_Query( $query_args );

		// Define the HTML layout of the blog items.
		$blog_items = core_get_template_part(

			// Path to blog template.
			'partials/blog/' . $layout_type,

			// Passing variables.
			array( 'custom_query' => $custom_query ),

			// Return contents.
			true
		);
	}

	// Check if the heading or content has some values.
	if ( ! empty( $section_heading ) || ! empty( $blog_items ) ) {

		// Define the HTML layout of the section content.
		$section_content =
		'<div class="' . $container_width . '">' .
			'<div class="row">' .
				$section_heading .
				$blog_items .
			'</div>' .
		'</div>';
	}

	// Convert the attributes to string.
	$attributes = core_attr_to_html( $attributes );

	// Define the HTML layout of the section block.
	$section_layout = '<section ' . $attributes . '>' . $section_content . '</section>';

// Selected portfolio section type.
} elseif ( $section_type == 'portfolio' ) {

	// Check if portfolio extension is active.
	if ( core_extension_is_active( 'portfolio' ) ) {

		// Specifying the initial settings.
		$section_content   = '';
		$portfolio_items   = '';
		$portfolio_filters = '';

		// Define projects selection type.
		$selection_type = fw_akg( 'portfolio/selection/selection_type', $options_values );

		// Define portfolio post type name.
		$post_type = _core_get_portfolio_post_type_name();

		// Define portfolio taxonomy name.
		$taxonomy_name = _core_get_portfolio_taxonomy_name();

		// Selected custom selection type.
		if ( $selection_type == 'custom' ) {

			// Define custom projects identifiers.
			$projects_ids = fw_akg( 'portfolio/selection/custom/projects_ids', $options_values );

			// Check if the option has some value.
			if ( ! empty( $projects_ids ) ) {

				// Define query arguments.
				$query_args = array(
					'post_type'      => array( $post_type ),
					'posts_per_page' => 18,
					'no_found_rows'  => true,
					'meta_query'     => array(
						array( 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ),
					),
					'post__in' => $projects_ids,
					'orderby'  => 'post__in',
				);
			}

		// Selected default selection type.
		} elseif ( $selection_type == 'default' ) {

			// Define selection condition.
			$condition_type = fw_akg( 'portfolio/selection/default/condition', $options_values );

			// Define projects count.
			$projects_count = fw_akg( 'portfolio/selection/default/count', $options_values );

			// Selected recent condition type.
			if ( $condition_type == 'recent' ) {

				// Define query arguments.
				$query_args = array(
					'post_type'      => array( $post_type ),
					'posts_per_page' => $projects_count,
					'no_found_rows'  => true,
					'meta_query'     => array(
						array( 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ),
					),
				);

			// Selected random condition type.
			} elseif ( $condition_type == 'random' ) {

				// Define query arguments.
				$query_args = array(
					'post_type'      => array( $post_type ),
					'posts_per_page' => $projects_count,
					'no_found_rows'  => true,
					'meta_query'     => array(
						array( 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ),
					),
					'orderby' => 'rand',
				);
			}
		}

		// Define portfolio layout type.
		$layout_type = fw_akg( 'portfolio/layout', $options_values );

		// Define layout columns count.
		$columns_count = fw_akg( 'portfolio/columns', $options_values );

		// Define displaying filters.
		$display_filters = fw_akg( 'portfolio/filters', $options_values );

		// Check if query arguments is defined.
		if ( isset( $query_args ) && ! empty( $query_args ) ) {

			$custom_query = new WP_Query( $query_args );

			$terms = get_terms( $taxonomy_name, array(
				'hierarchical' => false,
				'object_ids'   => wp_list_pluck( $custom_query->posts, 'ID' ),
			) );

			$filtering_classes = fw_ext_portfolio_get_sort_classes(
				$custom_query->posts,
				fw_ext_portfolio_get_listing_categories( null )
			);

			$transmitted_data = array(
				'custom_query'      => $custom_query,
				'filtering_classes' => $filtering_classes,
				'taxonomy_name'     => $taxonomy_name,
				'columns_count'     => $columns_count,
				'terms_list'        => $terms,
				'found_posts'       => count( $custom_query->posts ),
			);

			// Define the HTML layout of the portfolio items.
			$portfolio_items = core_get_template_part(

				// Path to portfolio template.
				'partials/portfolio/' . $layout_type,

				// Passing variables.
				$transmitted_data,

				// Return contents.
				true
			);

			// Check if need to show filters.
			if ( $display_filters == 'show' ) {

				// Define the HTML layout of the filters.
				$portfolio_filters = core_get_template_part(

					// Path to filters template.
					'partials/portfolio/filters',

					// Passing variables.
					$transmitted_data,

					// Return contents.
					true
				);
			}
		}

		// Check if the heading or content has some values.
		if ( ! empty( $section_heading ) || ! empty( $portfolio_items ) ) {

			// Define the HTML layout of the section content.
			$section_content =
			'<div class="' . $container_width . '">' .
				$section_heading .
				$portfolio_filters .
				$portfolio_items .
			'</div>';
		}

		// Convert the attributes to string.
		$attributes = core_attr_to_html( $attributes );

		// Define the HTML layout of the section block.
		$section_layout = '<section ' . $attributes . '>' . $section_content . '</section>';
	}

// Selected map section type.
} elseif ( $section_type == 'map' ) {

	// Specifying the initial settings.
	$section_content = '';

	$locations_option = fw_akg( 'map/locations', $options_values );
	$map_zoom         = fw_akg( 'map/zoom', $options_values ) + 10;

	$position_list    = array();
	$description_list = array();

	// Check to see if at least one set of coordinates.
	if ( ! empty( $locations_option ) ) {

		foreach ( $locations_option as $location ) {

			$location_position    = $location['position'];
			$location_description = preg_replace( '/\r|\n/', '', nl2br( $location['description'] ) );

			if ( ! empty( $location_position ) ) {
				$position_list[]    = '[' . $location_position . ']';
				$description_list[] = '[' . $location_description . ']';
			}
		}
	}

	$position_list    = ( ! empty( $position_list ) ) ? implode( ',', $position_list ) : '[]';
	$description_list = ( ! empty( $description_list ) ) ? implode( ',', $description_list ) : '[]';

	if ( _core_get_google_maps_api_key() ) {

		// Define the HTML layout of the section content.
		$section_content =
		'<div class="map" ' .
			'data-addresses="' . esc_attr( $position_list ) . '" ' .
			'data-info="' . esc_attr( $description_list ) . '" ' .
			'data-icon="' . get_template_directory_uri() . '/assets/images/map-icon.png" ' .
			'data-zoom="' . $map_zoom . '">' .
		'</div>';
	}

	// Define the HTML layout of the section block.
	$section_layout =
	'<section id="' . $section_id . '" class="maps-container module-gray">' .
		$section_content .
	'</section>';
}

// Output the HTML layout of the section block.
echo $section_layout;

?>
