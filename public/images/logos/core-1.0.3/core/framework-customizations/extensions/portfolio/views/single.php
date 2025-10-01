<?php get_header(); ?>

<section class="module">
	<div class="container">

		<?php
		// Get project template.
		get_template_part(

			// Path to project template.
			'partials/project/' . core_get_project_layout_type()
		); ?>

	</div>
</section>

<?php core_additional_projects(); ?>

<section class="module-sm module-gray">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="ps-prev">
					<?php next_post_link( '%link', '<span class="arrows arrows-arrows-slim-left"></span>' ); ?>
				</div>
			</div>
			<div class="col">
				<div class="ps-all">
					<a class="h4" href="<?php echo core_all_projects_page_url(); ?>"><?php _e( 'All Works', 'core' ); ?></a>
				</div>
			</div>
			<div class="col">
				<div class="ps-next">
					<?php previous_post_link( '%link', '<span class="arrows arrows-arrows-slim-right"></span>' ); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
