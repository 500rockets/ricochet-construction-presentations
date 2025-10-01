<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'icon_list' => array(
		'type'            => 'addable-popup',
		'label'           => __( 'Items', 'core' ),
		'desc'            => __( 'The list items can have icons and can be of various types.', 'core' ),
		'template'        => '{{' .
			'if (icon["icon-class-without-root"] != undefined && icon["icon-class-without-root"] != "") {' .
				'}}<span class="fw-text-capitalize">{{-icon["icon-class-without-root"].replace(/-/g," ")}}</span>{{' .
			'} else if (icon["attachment-id"] != undefined && icon["attachment-id"] != "") {' .
				'}}' . __( 'Custom upload', 'core' ) . '{{' .
			'} else {' .
				'}}' . __( 'Unnamed item', 'core' ) . '{{' .
			'}' .
		'}}',
		'popup-title'     => __( 'List Item', 'core' ),
		'size'            => 'medium',
		'limit'           => 10,
		'add-button-text' => __( 'Add', 'core' ),
		'sortable'        => true,
		'popup-options'   => array(

			'icon' => array(
				'type'         => 'icon-v2',
				'preview_size' => 'medium',
				'modal_size'   => 'medium',
				'label'        => __( 'Icon', 'core' ),
				'desc'         => __( 'Assign the icon for icon list item.', 'core' ),
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
);

?>
