<div class="col-lg-8 m-auto">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'partials/post/content', 'standard' ); ?>

	<?php endwhile; ?>

</div>
