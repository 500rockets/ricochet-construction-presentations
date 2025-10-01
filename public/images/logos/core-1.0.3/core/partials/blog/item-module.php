<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

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
