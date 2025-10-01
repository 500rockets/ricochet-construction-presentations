<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'page_header_settings' => array(
		'type'    => 'box',
		'title'   => __( 'Page Header Settings', 'core' ),
		'options' => array(

			'page_header' => array(
				'type'          => 'multi',
				'label'         => false,
				'inner-options' => array(

					'display' => array(
						'type'   => 'multi-picker',
						'label'  => false,
						'desc'   => false,
						'value'  => array(),
						'picker' => array(
							'display_choice' => array(
								'type'        => 'switch',
								'value'       => 'show',
								'label'       => __( 'Display', 'core' ),
								'desc'        => __( 'Show or hide the page header.', 'core' ),
								'left-choice' => array(
									'value' => 'hide',
									'label' => __( 'Hide', 'core' ),
								),
								'right-choice' => array(
									'value' => 'show',
									'label' => __( 'Show', 'core' ),
								),
							),
						),
						'choices' => array(
							'show' => _core_get_options_config( 'page-header' ),
						),
						'show_borders' => true,
					),
				),
			),
		),
	),

	'additional_settings' => array(
		'type'     => 'box',
		'title'    => __( 'Additional Settings', 'core' ),
		'context'  => 'side',
		'priority' => 'low',
		'options'  => array(

			'special_navigation_menu' => array(
				'type'    => 'select',
				'value'   => 'default',
				'label'   => __( 'Menu', 'core' ),
				'desc'    => __( 'Select the menu that will be displayed on this page.', 'core' ),
				'choices' => array(
					'default' => __( 'Default', 'core' ),
				) + _core_array_key_prefix( wp_get_nav_menus( array( 'fields' => 'id=>name' ) ), 'menu_' ),
			),
		),
	),
);

?>
