<?php

$carousel_options = '';
$gallery_images   = fw_ext_portfolio_get_gallery_images();

if ( ! empty( $gallery_images ) ) {

	$transition_style = fw_get_db_post_option( get_the_ID(), 'gallery_layout/slider/transition' );

	if ( ! empty( $transition_style ) ) {
		$carousel_options = esc_attr( '{"transitionStyle":"' . $transition_style . '"}' );
	} ?>

	<div class="image-slider owl-carousel" data-carousel-options="<?php echo $carousel_options; ?>">

		<?php
		foreach ( $gallery_images as $image ) {
			echo wp_get_attachment_image( $image['attachment_id'], 'full' );
		} ?>

	</div>

<?php } ?>
