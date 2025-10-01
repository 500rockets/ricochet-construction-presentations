<div class="col-lg-8 order-lg-2">
	<div class="row blog-masonry">

		<?php if ( $custom_query->have_posts() ) : ?>

			<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

				<div class="col-md-6 col-lg-6 post-item">

					<?php get_template_part( 'partials/blog/item', 'module' ); ?>

				</div>

			<?php endwhile; ?>

			<?php wp_reset_postdata(); ?>

		<?php else : ?>

			<?php get_template_part( 'partials/blog/no-posts' ); ?>

		<?php endif; ?>

	</div>
</div>

<div class="col-lg-4 order-lg-1">
	<div class="sidebar sidebar-left">
		<?php get_sidebar(); ?>
	</div>
</div>
