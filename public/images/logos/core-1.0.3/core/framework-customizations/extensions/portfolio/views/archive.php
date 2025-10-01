<?php

get_header();

$taxonomy  = _core_get_portfolio_taxonomy_name();
$terms     = get_terms( $taxonomy, array( 'hierarchical' => false ) );
$projects  = $wp_query->posts;
$num_pages = $wp_query->max_num_pages;

$filtering_classes = fw_ext_portfolio_get_sort_classes( $projects, fw_ext_portfolio_get_listing_categories( null ) );

$transmitted_data = array(
	'custom_query'      => $wp_query,
	'filtering_classes' => $filtering_classes,
	'taxonomy_name'     => $taxonomy,
	'columns_count'     => core_get_portfolio_columns_count(),
	'terms_list'        => $terms,
	'found_posts'       => $wp_query->found_posts,
); ?>

<section class="portfolio-container p-t-xs-0 p-t-sm-0 p-b-0">
	<div class="container-fluid">

		<?php

		// Get filters template.
		core_get_template_part(

			// Path to filters template.
			'partials/portfolio/filters',

			// Passing variables.
			$transmitted_data
		);

		/**
		 * Get portfolio template.
		 *
		 * @see core_get_portfolio_layout_type()
		 */
		core_get_template_part(

			// Path to portfolio template.
			'partials/portfolio/' . core_get_portfolio_layout_type(),

			// Passing variables.
			$transmitted_data
		); ?>

		<div id="next-projects" data-num-pages="<?php echo $num_pages; ?>">
			<?php next_posts_link( '', $num_pages ); ?>
		</div>
		<div id="loading-image" class="filter-loader d-none"></div>
	</div>
</section>

<?php get_footer(); ?>
