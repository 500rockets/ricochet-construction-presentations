<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

/**
 * Get project categories names.
 *
 * @param string $project_id    Project ID.
 * @param string $taxonomy_name Portfolio taxonomy name.
 * @param string $delimeter     Delimiter between category names.
 *
 * @return string List of project categories names.
 */
function core_get_project_categories_names( $project_id = '', $taxonomy_name = '', $delimeter = '' ) {

	// Specifying the initial settings.
	$categories_names = '';

	// Check if project ID and taxonomy name is defined.
	if ( ! empty( $project_id ) && ! empty( $taxonomy_name ) ) {

		// Define project categories names.
		$categories_names = wp_get_object_terms( $project_id, $taxonomy_name, array( 'fields' => 'names' ) );
	}

	// Return project categories names.
	return implode( $delimeter, $categories_names );
}



/**
 * Get list of project block classes.
 *
 * @param string $project_id                 Project ID.
 * @param array  $projects_filtering_classes Set of classes of all projects obtained
 *                                           with the use of fw_ext_portfolio_get_sort_classes
 *                                           and fw_ext_portfolio_get_listing_categories functions.
 *
 * @return string List of project block classes.
 */
function core_get_project_classes( $project_id = '', $projects_filtering_classes = array() ) {

	// Define default classes.
	$project_classes = array( 'portfolio-item' );

	// Check if project ID is defined and has filtering classes.
	if ( ! empty( $project_id ) && isset( $projects_filtering_classes[ $project_id ] ) ) {

		// Merge default classes and filtering classes.
		$filtering_classes = explode( ' ', trim( $projects_filtering_classes[ $project_id ] ) );
		$project_classes   = array_merge( $project_classes, $filtering_classes );
	}

	// Return list of classes.
	return implode( ' ', $project_classes );
}



/**
 * Get URL to all portfolio projects.
 * Return URL to Portfolio archive or to some custom page.
 *
 * @return string URL to portfolio projects.
 */
function core_all_projects_page_url() {

	$page_url    = '#';
	$page_choice = fw_get_db_customizer_option( 'all_projects_page/all_projects_page_type' );

	// Сheck if selected custom page.
	if ( $page_choice == 'custom' ) {

		$page_ids = fw_get_db_customizer_option( 'all_projects_page/custom/all_projects_page_ids' );

		if ( ! empty( $page_ids ) ) {
			$page_url = get_permalink( $page_ids[0] );
		}

	// Selected archive page.
	} elseif ( $page_choice == 'archive' ) {

		$post_type = _core_get_portfolio_post_type_name();

		if ( ! empty( $post_type ) ) {
			$page_url = get_post_type_archive_link( $post_type );
		}
	}

	// Return URL.
	return $page_url;
}



/**
 * Get number of portfolio projects per one page.
 *
 * @return string Number of portfolio projects per one page.
 */
function core_get_portfolio_projects_per_page() {

	// Get value from option.
	$projects_number = fw_get_db_customizer_option( 'projects_per_page' );

	// Set default value if option is empty.
	if ( empty( $projects_number ) ) {
		$projects_number = '6';
	}

	// Return projects number.
	return apply_filters( 'core_portfolio_projects_per_page', $projects_number );
}



/**
 * Get portfolio layout type.
 *
 * @return string Portfolio layout type.
 */
function core_get_portfolio_layout_type() {

	// Get value from option.
	$layout_type = fw_get_db_customizer_option( 'portfolio_layout_type' );

	// Set default value if option is empty.
	if ( empty( $layout_type ) ) {
		$layout_type = 'standard';
	}

	// Return layout type.
	return apply_filters( 'core_portfolio_layout_type', $layout_type );
}



/**
 * Get count of columns of the portfolio layout.
 *
 * @return string Columns count.
 */
function core_get_portfolio_columns_count() {

	// Get value from option.
	$columns_count = fw_get_db_customizer_option( 'layout_columns_count' );

	// Set default value if option is empty.
	if ( empty( $columns_count ) ) {
		$columns_count = '3';
	}

	// Return columns count.
	return apply_filters( 'core_portfolio_columns_count', $columns_count );
}



/**
 * Get project layout type.
 *
 * @return string Project layout type.
 */
function core_get_project_layout_type() {

	// Get value from option.
	$layout_type = fw_get_db_post_option( get_the_ID(), 'general_layout' );

	// Set default value if option is empty.
	if ( empty( $layout_type ) ) {
		$layout_type = 'standard';
	}

	// Return layout type.
	return $layout_type;
}



/**
 * Get project gallery layout type.
 *
 * @return string Project gallery layout type.
 */
function core_get_project_gallery_layout_type() {

	// Get value from option.
	$layout_type = fw_get_db_post_option( get_the_ID(), 'gallery_layout/layout_type' );

	// Set default value if option is empty.
	if ( empty( $layout_type ) ) {
		$layout_type = 'standard';
	}

	// Return layout type.
	return $layout_type;
}



/**
 * Get count of columns of the project gallery.
 *
 * @return string Columns count.
 */
function core_get_project_gallery_columns_count() {

	// Get value from option.
	$columns_count = fw_get_db_post_option( get_the_ID(), 'gallery_layout/standard/columns_count' );

	// Set default value if option is empty.
	if ( empty( $columns_count ) ) {
		$columns_count = '1';
	}

	// Return columns count.
	return $columns_count;
}



/**
 * Get the additional project info.
 *
 * @param boolean $echo Necessity of additional project info output.
 *
 * @return string HTML layout of the additional project info.
 */
function core_project_additional_info( $echo = true ) {

	// Specifying the initial settings.
	$additional_info = '';

	// Get value from option.
	$option_value = fw_get_db_post_option( get_the_ID(), 'info_list' );

	// Check if the option has some value.
	if ( ! empty( $option_value ) ) {

		// Processing data of the each list item.
		foreach ( $option_value as $list_item ) {

			// Define item name.
			$item_name = esc_html( $list_item['name'] );

			// Check the type of item.
			$item_type = fw_akg( 'type', $list_item );

			// Define content of the list item.
			$item_content = _core_get_special_typed_content( $item_type );

			// Check if item name is not empty.
			if ( $item_name != '' ) {

				// Define the HTML layout of the item name.
				$item_name = '<h5>' . $item_name . '&#58;</h5>';
			}

			// Supplement the HTML layout of the additional project info.
			$additional_info .= '<li>' . $item_name . $item_content . '</li>';
		}
	}

	// Check the need for output.
	if ( $echo ) {

		// Output the HTML layout of the additional project info.
		echo $additional_info;

	// The output is not needed.
	} else {

		// Return the HTML layout of the additional project info.
		return $additional_info;
	}
}



/**
 * Get the additional projects block.
 *
 * @param boolean $echo Necessity of additional projects block output.
 *
 * @return string HTML layout of the additional projects block.
 */
function core_additional_projects( $echo = true ) {

	$projects_block_layout = '';

	$projects_block_option_value = fw_get_db_customizer_option( 'additional_projects' );
	$display_projects_block      = fw_akg( 'show_projects/display_choice', $projects_block_option_value );

	// Check the setting value of the display of additional projects block.
	if ( $display_projects_block == 'show' ) {

		// Define projects block title.
		$block_title = esc_html( fw_akg( 'show_projects/show/title', $projects_block_option_value ) );

		// Define the need for output projects block title.
		if ( ! empty( $block_title ) ) {

			// Define the HTML layout of the projects block title.
			$block_title =
			'<div class="row">' .
				'<div class="col-md-12">' .
					'<h4 class="text-uppercase text-center m-b-50">' . $block_title . '</h4>' .
				'</div>' .
			'</div>';
		}

		// Define projects selection type.
		$selection_type = fw_akg( 'show_projects/show/selection/selection_type', $projects_block_option_value );

		// Define portfolio post type name.
		$post_type = _core_get_portfolio_post_type_name();

		// Define portfolio taxonomy name.
		$taxonomy_name = _core_get_portfolio_taxonomy_name();

		// Selected recent selection type.
		if ( $selection_type == 'recent' ) {

			// Define query arguments.
			$query_args = array(
				'post_type'      => array( $post_type ),
				'posts_per_page' => 3,
				'no_found_rows'  => true,
				'meta_query'     => array(
					array( 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ),
				),
			);

		// Selected random selection type.
		} elseif ( $selection_type == 'random' ) {

			// Define query arguments.
			$query_args = array(
				'post_type'      => array( $post_type ),
				'posts_per_page' => 3,
				'no_found_rows'  => true,
				'meta_query'     => array(
					array( 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ),
				),
				'orderby' => 'rand',
			);

		// Selected custom selection type.
		} elseif ( $selection_type == 'custom' ) {

			// Define custom projects identifiers.
			$projects_ids = fw_akg( 'show_projects/show/selection/custom/additional_projects_ids', $projects_block_option_value );

			// Check if the option has some value.
			if ( ! empty( $projects_ids ) ) {

				// Define query arguments.
				$query_args = array(
					'post_type'      => array( $post_type ),
					'posts_per_page' => 3,
					'no_found_rows'  => true,
					'meta_query'     => array(
						array( 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ),
					),
					'post__in' => $projects_ids,
					'orderby'  => 'post__in',
				);
			}
		}

		// Check if query arguments is defined.
		if ( isset( $query_args ) && ! empty( $query_args ) ) {

			$custom_query = new WP_Query( $query_args );

			$transmitted_data = array(
				'custom_query'      => $custom_query,
				'filtering_classes' => array(),
				'columns_count'     => '3',
			);

			// Define the HTML layout of the portfolio items.
			$portfolio_items = core_get_template_part(

				// Path to portfolio template.
				'partials/portfolio/gallery',

				// Passing variables.
				$transmitted_data,

				// Return contents.
				true
			);

			// Define the HTML layout of the additional projects block.
			$projects_block_layout =
			'<section class="module module-divider-top">' .
				'<div class="container">' .
					$block_title .
					$portfolio_items .
				'</div>' .
			'</section>';
		}
	}

	// Check the need for output.
	if ( $echo ) {

		// Output the HTML layout of the additional projects block.
		echo $projects_block_layout;

	// The output is not needed.
	} else {

		// Return the HTML layout of the additional projects block.
		return $projects_block_layout;
	}
}

?>
