<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'icon' => array(
		'type'         => 'icon-v2',
		'preview_size' => 'medium',
		'modal_size'   => 'medium',
		'label'        => __( 'Icon', 'core' ),
		'desc'         => __( 'Assign the icon for icon box.', 'core' ),
	),

	'title' => array(
		'type'  => 'text',
		'value' => '',
		'label' => __( 'Title', 'core' ),
		'desc'  => __( 'Enter the title of the icon box.', 'core' ),
	),

	'content' => array(
		'type'  => 'textarea',
		'label' => __( 'Content', 'core' ),
		'desc'  => __( 'Enter the content of the icon box.', 'core' ),
		'help'  => __( 'You can use line breaks.', 'core' ),
		'attr'  => array( 'rows' => '3' ),
	),

	'layout' => array(
		'type'  => 'image-picker',
		'value' => 'text-center',
		'label' => __( 'Layout', 'core' ),
		'desc'  => __( 'Select the layout type of the icons box.', 'core' ),
		'choices' => array(
			'text-center' => array(
				'small' => array(
					'height' => 80,
					'src'    => fw_get_template_customizations_directory_uri() .
								'/extensions/shortcodes/shortcodes/core-icon-box/static/img/layout-1.png',
				),
			),
			'text-left' => array(
				'small' => array(
					'height' => 80,
					'src'    => fw_get_template_customizations_directory_uri() .
								'/extensions/shortcodes/shortcodes/core-icon-box/static/img/layout-2.png',
				),
			),
			'text-right' => array(
				'small' => array(
					'height' => 80,
					'src'    => fw_get_template_customizations_directory_uri() .
								'/extensions/shortcodes/shortcodes/core-icon-box/static/img/layout-3.png',
				),
			),
			'icon-box-left' => array(
				'small' => array(
					'height' => 80,
					'src'    => fw_get_template_customizations_directory_uri() .
								'/extensions/shortcodes/shortcodes/core-icon-box/static/img/layout-4.png',
				),
			),
		),
		'blank' => false,
	),

	'info' => array(
		'type'   => 'multi-picker',
		'label'  => false,
		'desc'   => false,
		'value'  => array(),
		'picker' => array(
			'type_choice' => array(
				'type'    => 'radio',
				'value'   => 'text',
				'label'   => __( 'Info', 'core' ),
				'desc'    => __( 'Type of info, that appears at the bottom of icon box.', 'core' ),
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
					'desc'  => __( 'Info content of the text type.', 'core' ),
				),
			),

			'link' => _core_get_options_config( 'link' ),

			'email' => array(
				'address' => array(
					'type'  => 'text',
					'label' => __( 'Address', 'core' ),
					'desc'  => __( 'Info content of the e-mail address type.', 'core' ),
				),
			),
		),
		'show_borders' => false,
	),
);

?>
