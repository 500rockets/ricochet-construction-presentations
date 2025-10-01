<?php if ( $custom_query->have_posts() ) : ?>

	<div class="row row-portfolio" data-columns="<?php echo $columns_count; ?>">
		<div class="grid-sizer"></div>

		<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class( core_get_project_classes( get_the_ID(), $filtering_classes ) ); ?>>
				<div class="portfolio-wrapper">
					<?php the_post_thumbnail( 'core-project-dynamic' ); ?>
					<div class="portfolio-overlay"></div>
					<div class="portfolio-caption">
						<h5 class="portfolio-title"><?php the_title(); ?></h5>
					</div>
					<a class="portfolio-link" href="<?php the_permalink(); ?>"></a>
				</div>
			</div>

		<?php endwhile; ?>

		<?php wp_reset_postdata(); ?>

	</div>

<?php else : ?>

	<?php get_template_part( 'partials/portfolio/no-projects' ); ?>

<?php endif; ?>
