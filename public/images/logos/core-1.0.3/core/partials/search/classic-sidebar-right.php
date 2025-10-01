<div class="col-lg-8">

	<?php if ( $custom_query->have_posts() ) : ?>

		<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

			<?php get_template_part( 'partials/search/item', 'standard' ); ?>

		<?php endwhile; ?>

		<?php wp_reset_postdata(); ?>

	<?php else : ?>

		<?php get_template_part( 'partials/search/no-results' ); ?>

	<?php endif; ?>

</div>

<div class="col-lg-4">
	<div class="sidebar">
		<?php get_sidebar(); ?>
	</div>
</div>
