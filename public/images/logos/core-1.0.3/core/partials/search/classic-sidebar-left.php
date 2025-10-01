<div class="col-lg-8 order-lg-2">

	<?php if ( $custom_query->have_posts() ) : ?>

		<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

			<?php get_template_part( 'partials/search/item', 'standard' ); ?>

		<?php endwhile; ?>

		<?php wp_reset_postdata(); ?>

	<?php else : ?>

		<?php get_template_part( 'partials/search/no-results' ); ?>

	<?php endif; ?>

</div>

<div class="col-lg-4 order-lg-1">
	<div class="sidebar sidebar-left">
		<?php get_sidebar(); ?>
	</div>
</div>
