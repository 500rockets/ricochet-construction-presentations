<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$tabs_layout  = '';
$tabs_option  = $atts['tabs'];

// Check if the option has some value.
if ( ! empty( $tabs_option ) ) {

	// Specifying the initial settings.
	$tabs_nav     = '';
	$tabs_content = '';

	// Start processed tabs option.
	foreach ( $tabs_option as $index => $tab ) {

		// Define tab title.
		$tab_title = esc_html( $tab['title'] );

		// Define tab content.
		$tab_content = wp_kses_post( $tab['content'] );

		// Define tab icon.
		$tab_icon = esc_html( $tab['icon'] );

		// Check if the option has some value.
		if ( $tab_icon != '' ) {

			// Define the HTML layout of the tab icon.
			$tab_icon = '<i class="' . $tab_icon . '"></i>';
		}

		// Define tab status.
		$tab_active = ( $index == 0 ) ? 'active' : '';

		// Display tab only if filled title option and content option.
		if ( ! empty( $tab_title ) && ! empty( $tab_content ) ) {

			// Define unique tab identificator.
			$tab_id = 'tab' . fw_unique_increment();

			// Supplement the HTML layout of the tabs navigation.
			$tabs_nav .=
			'<li class="nav-item">' .
				'<a class="nav-link ' . $tab_active . '" href="#' . $tab_id . '" data-toggle="tab">' .
					$tab_icon .
					$tab_title .
				'</a>' .
			'</li>';

			// Supplement the HTML layout of the tabs content.
			$tabs_content .=
			'<div class="tab-pane ' . $tab_active . '" id="' . $tab_id . '">' .
				$tab_content .
				'<div class="clearfix"></div>' .
			'</div>';
		}
	}

	// Define tabs navigation alignment.
	$tabs_alignment = esc_attr( $atts['alignment'] );

	// Define the need for output tabs navigation.
	if ( ! empty( $tabs_nav ) ) {

		// Define the HTML layout of the tabs navigation.
		$tabs_nav = '<ul class="nav nav-tabs ' . $tabs_alignment . '">' . $tabs_nav . '</ul>';
	}

	// Define the need for output tabs content.
	if ( ! empty( $tabs_content ) ) {

		// Define the HTML layout of the tabs content.
		$tabs_content = '<div class="tab-content">' . $tabs_content . '</div>';
	}

	// Define the HTML layout of the tabs.
	$tabs_layout = $tabs_nav . $tabs_content;
}

// Output the HTML layout of the tabs.
echo $tabs_layout;

?>
