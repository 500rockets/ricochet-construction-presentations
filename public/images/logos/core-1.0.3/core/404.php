<?php get_header(); ?>

<section class="module">
	<div class="container">
		<div class="row">
			<div class="col-md-8 m-auto">
				<div class="module-title text-center">
					<h2><?php esc_html_e( 'Oops! That page not found.', 'core' ); ?></h2>
					<p class="font-serif">
						<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'core' ); ?>
					</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 m-auto">
				<div class="widget_search">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
