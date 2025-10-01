<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$team_member_layout = '';
$team_member_image  = esc_url( fw_akg( 'data/icon', $atts['image'] ) );

// Check if the option has some value.
if ( ! empty( $team_member_image ) ) {

	// Specifying the initial settings.
	$content_block = '';
	$social_block  = '';

	// Define team member name.
	$team_member_name = esc_html( $atts['name'] );
	$team_member_name = ( $team_member_name != '' ) ? '<h5>' . $team_member_name . '</h5>' : '';

	// Define team member job.
	$team_member_job = esc_html( $atts['job'] );
	$team_member_job = ( $team_member_job != '' ) ? '<p>' . $team_member_job . '</p>' : '';

	// Define the need for output team member content header.
	if ( ! empty( $team_member_name ) || ! empty( $team_member_job ) ) {

		// Define the HTML layout of the team member content block.
		$content_block =
		'<div class="team-content">' .
			$team_member_name .
			$team_member_job .
		'</div>';
	}

	// Start processed social links option.
	$social_links = '';

	// Check if the option has some value.
	if ( ! empty( $atts['social'] ) ) {

		foreach( $atts['social'] as $social_link ) {

			$icon = $social_link['icon_class'];
			$link = esc_url( $social_link['icon_link'] );
			$link = ( ! empty( $link ) ) ? $link : '#';

			// Check if the option has some value.
			if ( ! empty( $icon ) ) {

				// Supplement the HTML layout of social links.
				$social_links .= '<li><a href="' . $link . '" target="_blank"><i class="' . $icon . '"></i></a></li>';
			}
		}
	}

	// Define the need for output team member social block.
	if ( ! empty( $social_links ) ) {

		// Define the HTML layout of the team member social block.
		$social_block =
		'<div class="team-content-social">' .
			'<ul>' . $social_links . '</ul>' .
		'</div>';
	}

	// Define the HTML layout of the team member.
	$team_member_layout =
	'<div class="team-item">' .
		'<div class="team-image">' .
			'<img src="' . $team_member_image . '" alt="">' .
			$content_block.
			$social_block .
		'</div>' .
	'</div>';
}

// Output the HTML layout of the team member.
echo $team_member_layout;

?>
