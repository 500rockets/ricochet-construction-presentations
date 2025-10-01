<?php

// Template Name: Portfolio

get_header();

if ( core_extension_is_active( 'portfolio' ) ) {

	$taxonomy  = _core_get_portfolio_taxonomy_name();
	$post_type = _core_get_portfolio_post_type_name();
	$terms     = get_terms( $taxonomy, array( 'hierarchical' => false ) );

	$paged = ( is_front_page() ) ? max( 1, get_query_var( 'page' ) ) : max( 1, get_query_var( 'paged' ) );

	$custom_query = new WP_Query( array(
		'post_type'      => array( $post_type ),
		'posts_per_page' => core_get_portfolio_projects_per_page(),
		'paged'          => $paged,
	) );

	$projects  = $custom_query->posts;
	$num_pages = $custom_query->max_num_pages;

	$filtering_classes = fw_ext_portfolio_get_sort_classes( $projects, fw_ext_portfolio_get_listing_categories( null ) );

	$transmitted_data = array(
		'custom_query'      => $custom_query,
		'filtering_classes' => $filtering_classes,
		'taxonomy_name'     => $taxonomy,
		'columns_count'     => core_get_portfolio_columns_count(),
		'terms_list'        => $terms,
		'found_posts'       => $custom_query->found_posts,
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

<?php } else { ?>

	<section class="module">
		<div class="container-fluid">

			<?php get_template_part( 'partials/portfolio/no-projects' ); ?>

		</div>
	</section>

<?php }

get_footer(); ?>
