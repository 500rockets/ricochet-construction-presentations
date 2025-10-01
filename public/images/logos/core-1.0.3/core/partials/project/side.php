<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="row">
			<div class="col-lg-8">
				<div class="portfolio-content">

					<?php
					// Get gallery template.
					get_template_part(

						// Path to gallery template.
						'partials/project/gallery/' . core_get_project_gallery_layout_type()
					); ?>

				</div>
			</div>
			<div class="col-lg-4" data-sticky_parent>
				<div class="portfolio-sidebar sticky-sidebar" data-sticky_column>
					<h3 class="single-portfolio-title"><?php the_title(); ?></h3>
					<?php the_content(); ?>
					<div class="clearfix"></div>
					<div class="portfoli-details">
						<ul>
							<li><h5><?php _e( 'Date', 'core' ); ?>:</h5>
								<?php echo get_the_date(); ?>
							</li>
							<li><h5><?php _e( 'Categories', 'core' ); ?>:</h5>
								<?php echo get_the_term_list( get_the_ID(), _core_get_portfolio_taxonomy_name(), '', ', ', '' ); ?>
							</li>
							<?php core_project_additional_info(); ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</article>

<?php endwhile; ?>
