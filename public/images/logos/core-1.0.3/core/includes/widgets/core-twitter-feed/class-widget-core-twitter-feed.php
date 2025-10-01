<?php

class Widget_Core_Twitter_Feed extends WP_Widget {

	public function __construct() {
		parent::__construct( 'core-twitter-feed', __( 'Twitter Feed', 'core' ), array(
			'classname'   => 'twitter-feed-widget',
			'description' => __( 'Allows you to get your tweets displaying.', 'core' ),
		) );
	}

	function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Twitter Feed', 'core' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$twitter_id = isset( $instance['twitter_id'] ) ? $instance['twitter_id'] : '';

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 2;
		if ( ! $number ) { $number = 2; }

		echo $args['before_widget'];

		if ( $title ) echo $args['before_title'] . $title . $args['after_title']; ?>

		<div class="twitter-feed"
			 data-twitter="<?php echo esc_attr( $twitter_id ); ?>"
			 data-number="<?php echo esc_attr( $number ); ?>">
		</div>

		<?php
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']      = sanitize_text_field( $new_instance['title'] );
		$instance['number']     = (int) $new_instance['number'];
		$instance['twitter_id'] = isset( $new_instance['twitter_id'] ) ? (string) $new_instance['twitter_id'] : '';
		return $instance;
	}

	public function form( $instance ) {

		$title      = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number     = isset( $instance['number'] ) ? absint( $instance['number'] ) : 2;
		$twitter_id = isset( $instance['twitter_id'] ) ? (string) $instance['twitter_id'] : ''; ?>

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
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter_id' ) ); ?>">
				<?php echo esc_html__( 'Twitter ID', 'core' ) . '&#58;'; ?>
			</label>
			<input class="widefat"
				   id="<?php echo esc_attr( $this->get_field_id( 'twitter_id' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'twitter_id' ) ); ?>"
				   type="text"
				   value="<?php echo esc_attr( $twitter_id ); ?>"/>
			<em>
				<?php
				echo sprintf( '%1$s %2$s',
					__( 'You can find your Twitter ID by using special service.', 'core' ),
					'(<a target="_blank" href="http://www.mytwitterid.com/">MyTwitterID</a>)'
				); ?>
			</em>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>">
				<?php echo esc_html__( 'Number of tweets to show', 'core' ) . '&#58;'; ?>
			</label>
			<input class="tiny-text"
				   id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
				   name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>"
				   type="number"
				   step="1"
				   min="1"
				   max="10"
				   value="<?php echo esc_attr( $number ); ?>"
				   size="3"/>
		</p>

	<?php }
} ?>
