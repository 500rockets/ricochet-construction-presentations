<?php

class Widget_Core_Recent_Posts extends WP_Widget {

	public function __construct() {
		parent::__construct( 'core-recent-posts-special', __( 'Recent Posts Special', 'core' ), array(
			'classname'   => 'widget_recent_entries_custom',
			'description' => __( 'Most recent Posts.', 'core' ),
		) );
	}

	public function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'core' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) { $number = 5; }

		$show_date      = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : false;

		$custom_query = new WP_Query( array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) );

		if ( $custom_query->have_posts() ) {

			echo $args['before_widget'];
			if ( $title ) { echo $args['before_title'] . $title . $args['after_title']; } ?>

			<ul>
				<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
					<li class="clearfix w-100">

						<?php if ( $show_thumbnail && has_post_thumbnail() ) : ?>
							<div class="wi">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'thumbnail' ); ?>
								</a>
							</div>
						<?php endif; ?>

						<?php if ( $show_thumbnail && has_post_thumbnail() ) : ?><div class="wb"><?php endif; ?>

						<a href="<?php the_permalink(); ?>">
							<?php get_the_title() ? the_title() : the_ID(); ?>
						</a>
						<?php if ( $show_date ) : ?>
							<span class="post-date">
								<?php echo get_the_date(); ?>
							</span>
						<?php endif; ?>

						<?php if ( $show_thumbnail && has_post_thumbnail() ) : ?></div><?php endif; ?>

					</li>
				<?php endwhile; ?>
			</ul>

			<?php
			echo $args['after_widget'];
			wp_reset_postdata();
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']          = sanitize_text_field( $new_instance['title'] );
		$instance['number']         = (int) $new_instance['number'];
		$instance['show_date']      = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_thumbnail'] = isset( $new_instance['show_thumbnail'] ) ? (bool) $new_instance['show_thumbnail'] : false;
		return $instance;
	}

	public function form( $instance ) {

		$title          = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number         = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date      = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$show_thumbnail = isset( $instance['show_thumbnail'] ) ? (bool) $instance['show_thumbnail'] : false; ?>

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
				<?php echo esc_html__( 'Number of posts to show', 'core' ) . '&#58;'; ?>
			</label>
			<input class="tiny-text"
				   id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>"
				   type="number"
				   step="1"
				   min="1"
				   value="<?php echo esc_attr( $number ); ?>"
				   size="3"/>
		</p>

		<p>
			<input class="checkbox"
				   type="checkbox"<?php esc_attr( checked( $show_date ) ); ?>
				   id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>"/>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>">
				<?php echo esc_html__( 'Display post date', 'core' ); ?>
			</label>
		</p>

		<p>
			<input class="checkbox"
				   type="checkbox"<?php esc_attr( checked( $show_thumbnail ) ); ?>
				   id="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'show_thumbnail' ) ); ?>"/>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>">
				<?php echo esc_html__( 'Display thumbnail image', 'core' ); ?>
			</label>
		</p>

	<?php }
} ?>
