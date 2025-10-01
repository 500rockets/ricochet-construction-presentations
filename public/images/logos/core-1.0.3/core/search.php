<?php get_header(); ?>

<section class="module">
	<div class="container">
		<div class="row">

			<?php
			/**
			 * Get search template.
			 *
			 * @see core_get_sidebar_state()
			 */
			core_get_template_part(

				// Path to search template.
				'partials/search/classic' . '-' . core_get_sidebar_state(),

				// Passing variables.
				array( 'custom_query' => $wp_query )
			); ?>

		</div>
	</div>
</section>

<?php

// Get pagination template.
core_get_template_part(

	// Path to pagination template.
	'partials/blog/pagination-center',

	// Passing variables.
	array( 'custom_query' => $wp_query )
);

get_footer(); ?>
