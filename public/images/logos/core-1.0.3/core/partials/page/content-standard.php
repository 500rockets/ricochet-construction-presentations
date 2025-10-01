<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) : ?>
		<div class="post-preview"><?php the_post_thumbnail( 'large' ); ?></div>
	<?php endif; ?>

	<div class="post-header">
		<h1 class="post-title"><?php the_title(); ?></h1>
	</div>
	<div class="post-content">
		<?php the_content(); ?>
		<div class="clearfix"></div>
		<?php wp_link_pages(); ?>
	</div>
</article>

<?php if ( comments_open() || get_comments_number() ) { comments_template(); } ?>
