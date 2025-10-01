<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'layout_settings' => array(
		'type'    => 'box',
		'title'   => __( 'Layout Settings', 'core' ),
		'options' => array(

			'general_layout' => array(
				'type'  => 'radio',
				'value' => 'standard',
				'label' => __( 'General', 'core' ),
				'desc'  => __( 'General layout type of the entire portfolio project.', 'core' ),
				'choices' => array(
					'standard' => __( 'Standard', 'core' ),
					'side'     => __( 'Side', 'core' ),
				),
				'inline' => true,
			),

			'gallery_layout' => array(
				'type'   => 'multi-picker',
				'label'  => false,
				'desc'   => false,
				'value'  => array(),
				'picker' => array(
					'layout_type' => array(
						'type'  => 'radio',
						'value' => 'standard',
						'label' => __( 'Gallery', 'core' ),
						'desc'  => __( 'The layout type of the portfolio project gallery.', 'core' ),
						'choices' => array(
							'standard' => __( 'Standard', 'core' ),
							'slider'   => __( 'Slider', 'core' ),
						),
						'inline' => true,
					),
				),
				'choices' => array(

					'standard' => array(
						'columns_count' => array(
							'type'    => 'short-select',
							'value'   => '1',
							'label'   => __( 'Columns', 'core' ),
							'desc'    => __( 'Number of columns of the standard gallery.', 'core' ),
							'choices' => array( '1' => '1', '2' => '2', '3' => '3' ),
						),
					),

					'slider' => array(
						'transition' => array(
							'type'    => 'short-select',
							'value'   => '',
							'label'   => __( 'Transition', 'core' ),
							'desc'    => __( 'Transition style of the slider gallery.', 'core' ),
							'choices' => array(
								''          => __( 'Standard', 'core' ),
								'fade'      => __( 'Fade', 'core' ),
								'backSlide' => __( 'BackSlide', 'core' ),
								'goDown'    => __( 'GoDown', 'core' ),
								'fadeUp'    => __( 'FadeUp', 'core' ),
							),
						),
					),
				),
			),
		),
	),

	'additional_info' => array(
		'type'    => 'box',
		'title'   => __( 'Additional Info', 'core' ),
		'options' => array(

			'info_list' => array(
				'type'            => 'addable-popup',
				'label'           => __( 'Items', 'core' ),
				'desc'            => __( 'The list items can have names and can be of various types.', 'core' ),
				'template'        => '{{if(name==""){}}' . __( 'Unnamed item', 'core' ) . '{{}else{}}{{-name}}{{}}}',
				'popup-title'     => __( 'List Item', 'core' ),
				'size'            => 'small',
				'limit'           => 5,
				'add-button-text' => __( 'Add', 'core' ),
				'sortable'        => true,
				'popup-options'   => array(

					'name' => array(
						'type'  => 'text',
						'label' => __( 'Name', 'core' ),
						'desc'  => __( 'List item name.', 'core' ),
					),

					'type' => array(
						'type'   => 'multi-picker',
						'label'  => false,
						'desc'   => false,
						'value'  => array(),
						'picker' => array(
							'type_choice' => array(
								'type'    => 'radio',
								'value'   => 'text',
								'label'   => __( 'Type', 'core' ),
								'desc'    => __( 'List item content type.', 'core' ),
								'choices' => array(
									'text'  => __( 'Text', 'core' ),
									'link'  => __( 'Link', 'core' ),
									'email' => __( 'E-mail', 'core' ),
								),
								'inline' => true,
							),
						),
						'choices' => array(

							'text' => array(
								'content' => array(
									'type'  => 'text',
									'label' => __( 'Content', 'core' ),
									'desc'  => __( 'Content of the text type.', 'core' ),
								),
							),

							'link' => _core_get_options_config( 'link' ),

							'email' => array(
								'address' => array(
									'type'  => 'text',
									'label' => __( 'Address', 'core' ),
									'desc'  => __( 'Content of the e-mail address type.', 'core' ),
								),
							),
						),
						'show_borders' => false,
					),
				),
			),
		),
	),

	'project_header_settings' => array(
		'type'    => 'box',
		'title'   => __( 'Project Header Settings', 'core' ),
		'options' => array(

			'project_header' => array(
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
