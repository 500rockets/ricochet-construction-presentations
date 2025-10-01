<?php if ( ! empty( $terms_list ) ) : ?>

	<?php
	/**
	 * Hide filters, if at the moment there is only one term
	 * and the number of all the queried posts is less or equal
	 * to the number of posts of this term.
	 */
	if ( ! ( count( $terms_list ) == 1 && $found_posts <= $terms_list[0]->count ) ) : ?>

		<div class="row row-portfolio-filter">
			<div class="col-md-12">
				<ul class="filters h5" id="filters">

					<li><a class="current" href="#" data-filter="*">
						<?php _e( 'All', 'core' ); ?>
					</a></li>

					<?php foreach ( $terms_list as $term ) : ?>
						<li><a href="#" data-filter=".category_<?php echo $term->term_id; ?>">
							<?php echo $term->name; ?>
						</a></li>
					<?php endforeach; ?>

				</ul>
			</div>
		</div>

	<?php endif; ?>

<?php endif; ?>
