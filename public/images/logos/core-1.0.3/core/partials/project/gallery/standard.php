<?php

$gallery_images = fw_ext_portfolio_get_gallery_images();

if ( ! empty( $gallery_images ) ) : ?>

	<div class="gallery gallery-columns-<?php echo esc_attr( core_get_project_gallery_columns_count() ); ?>">

		<?php foreach ( $gallery_images as $image ) : ?>

				<figure class="gallery-item">
					<div class="gallery-icon">
						<a href="<?php echo esc_url( $image['url'] ); ?>" rel="gallery">
							<?php echo wp_get_attachment_image( $image['attachment_id'], 'full' ); ?>
						</a>
					</div>
				</figure>

		<?php endforeach; ?>

	</div>

<?php endif; ?>
