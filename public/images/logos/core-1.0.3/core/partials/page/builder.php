<?php while ( have_posts() ) : the_post();

	the_content();

	if ( comments_open() || get_comments_number() ) : ?>

		<section class="module p-t-60 p-b-0">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 m-auto">
						<?php comments_template();?>
					</div>
				</div>
			</div>
		</section>

	<?php endif; ?>

<?php endwhile; ?>
