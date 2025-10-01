<div class="col-lg-8">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'partials/post/content', 'standard' ); ?>

	<?php endwhile; ?>

</div>

<div class="col-lg-4">
	<div class="sidebar">
		<?php get_sidebar(); ?>
	</div>
</div>
