<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'post_header_settings' => array(
		'type'    => 'box',
		'title'   => __( 'Post Header Settings', 'core' ),
		'options' => array(

			'post_header' => array(
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
								'value'       => 'hide',
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
);

?>
