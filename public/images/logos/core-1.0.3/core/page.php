<?php

get_header();

if ( ! core_is_builder_post() ) : ?>

	<section class="module">
		<div class="container">
			<div class="row">

				<?php
				/**
				 * Get page template.
				 *
				 * @see core_get_sidebar_state()
				 */
				get_template_part(

					// Path to page type.
					'partials/page/classic',

					// Sidebar state.
					core_get_sidebar_state()
				); ?>

			</div>
		</div>
	</section>

<?php

else:

	// Get page template.
	get_template_part( 'partials/page/builder' );

endif;

get_footer(); ?>
