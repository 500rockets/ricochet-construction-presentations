<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>

	<?php if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) : ?>
		<div class="post-preview">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
		</div>
	<?php endif; ?>

	<div class="post-wrapper">
		<div class="post-header">
			<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<ul class="post-meta h5">
				<li><?php echo get_the_date(); ?></li>

				<?php
				// Check if current post is a single portfolio project.
				if ( get_post_type( get_the_ID() ) === _core_get_portfolio_post_type_name() ) {

					echo get_the_term_list( get_the_ID(), _core_get_portfolio_taxonomy_name(), '<li>', ', ', '</li>' );

				// If current post is not a single portfolio project.
				} else {

					echo get_the_term_list( get_the_ID(), 'category', '<li>', ', ', '</li>' );
				} ?>

				<?php
				// Check if current post type supports comments.
				if ( post_type_supports( get_post_type(), 'comments' ) ) : ?>

					<li><a href="<?php the_permalink(); ?>#comments"><?php comments_number(); ?></a></li>

				<?php endif; ?>

			</ul>
		</div>
		<div class="post-content">
			<?php the_excerpt(); ?>
		</div>
		<div class="post-more">
			<a href="<?php the_permalink(); ?>"><?php echo __( 'Read More', 'core' ) . ' &rarr;'; ?></a>
		</div>
	</div>
</article>
