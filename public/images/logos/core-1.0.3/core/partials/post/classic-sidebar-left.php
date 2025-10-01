<div class="col-lg-8 order-lg-2">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'partials/post/content', 'standard' ); ?>

	<?php endwhile; ?>

</div>

<div class="col-lg-4 order-lg-1">
	<div class="sidebar sidebar-left">
		<?php get_sidebar(); ?>
	</div>
</div>
