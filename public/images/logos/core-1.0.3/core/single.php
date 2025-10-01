<?php get_header(); ?>

<section class="module">
	<div class="container">
		<div class="row">

			<?php
			/**
			 * Get post template.
			 *
			 * @see core_get_sidebar_state()
			 */
			get_template_part(

				// Path to post type.
				'partials/post/classic',

				// Sidebar state.
				core_get_sidebar_state()
			); ?>

		</div>
	</div>
</section>

<?php get_footer(); ?>
