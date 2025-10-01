<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) : ?>
		<div class="post-preview"><?php the_post_thumbnail( 'large' ); ?></div>
	<?php endif; ?>

	<div class="post-header">
		<h1 class="post-title"><?php the_title(); ?></h1>
		<ul class="post-meta h5">
			<li><?php echo get_the_date(); ?></li>
			<?php echo get_the_term_list( get_the_ID(), 'category', '<li>', ', ', '</li>' ); ?>
			<li><a href="<?php the_permalink(); ?>#comments"><?php comments_number(); ?></a></li>
		</ul>
	</div>
	<div class="post-content">
		<?php the_content(); ?>
		<div class="clearfix"></div>
		<?php wp_link_pages(); ?>
	</div>
	<div class="post-footer">
		<div class="post-tags">
			<?php the_tags( '', '', '' ); ?>
		</div>
	</div>
</article>

<?php comments_template() ?>
