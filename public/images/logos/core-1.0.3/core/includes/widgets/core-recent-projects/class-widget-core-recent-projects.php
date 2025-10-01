<?php

class Widget_Core_Recent_Projects extends WP_Widget {

	public function __construct() {
		parent::__construct( 'core-recent-projects', __( 'Recent Projects', 'core' ), array(
			'classname'   => 'widget_recent_works',
			'description' => __( 'Most recent Projects.', 'core' ),
		) );
	}

	public function widget( $args, $instance ) {

		if ( core_extension_is_active( 'portfolio' ) ) {

			if ( ! isset( $args['widget_id'] ) ) {
				$args['widget_id'] = $this->id;
			}

			$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Projects', 'core' );
			$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

			$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 6;
			if ( ! $number ) { $number = 6; }

			$custom_query = new WP_Query( array(
				'post_type'      => array( _core_get_portfolio_post_type_name() ),
				'posts_per_page' => $number,
				'no_found_rows'  => true,
				'meta_query'     => array(
					array( 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ),
				),
			) );

			if ( $custom_query->have_posts()) {

				echo $args['before_widget'];
				if ( $title ) { echo $args['before_title'] . $title . $args['after_title']; } ?>

				<ul>
					<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'thumbnail' ); ?>
						</a></li>
					<?php endwhile; ?>
				</ul>

				<?php
				echo $args['after_widget'];
				wp_reset_postdata();
			}
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']  = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		return $instance;
	}

	public function form( $instance ) {

		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 6; ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php echo esc_html__( 'Title', 'core' ) . '&#58;'; ?>
			</label>
			<input class="widefat"
				   id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				   type="text"
				   value="<?php echo esc_attr( $title ); ?>"/>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>">
				<?php echo esc_html__( 'Number of projects to show', 'core' ) . '&#58;'; ?>
			</label>
			<input class="tiny-text"
				   id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>"
				   type="number"
				   step="1"
				   min="1"
				   max="9"
				   value="<?php echo esc_attr( $number ); ?>"
				   size="3"/>
		</p>

	<?php }
} ?>
