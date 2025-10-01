<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'label' => array(
		'type'  => 'text',
		'value' => '',
		'label' => __( 'Label', 'core' ),
		'desc'  => __( 'Enter the text displayed in the link.', 'core' ),
	),

	'url_type' => array(
		'type'   => 'multi-picker',
		'label'  => false,
		'desc'   => false,
		'value'  => array(),
		'picker' => array(
			'type_choice' => array(
				'type'    => 'radio',
				'value'   => 'custom',
				'label'   => __( 'URL', 'core' ),
				'desc'    => __( 'Specify the URL which link goes to.', 'core' ),
				'choices' => array(
					'custom' => __( 'Custom', 'core' ),
					'pages'  => __( 'Pages', 'core' ),
				),
				'inline' => true,
			),
		),
		'choices' => array(

			'custom' => array(

				'url' => array(
					'type'  => 'text',
					'value' => '#',
					'label' => '',
				),
			),

			'pages' => array(

				'source_id' => array(
					'type'        => 'multi-select',
					'value'       => '',
					'label'       => '',
					'population'  => 'posts',
					'source'      => 'page',
					'prepopulate' => 50,
					'limit'       => 1,
				),
			),
		),
		'show_borders' => false,
	),

	'target' => array(
		'type'  => 'switch',
		'value' => '_blank',
		'label' => __( 'Target', 'core' ),
		'desc'  => __( 'Specify where to open the link.', 'core' ),
		'right-choice' => array(
			'value' => '_blank',
			'label' => __( 'Blank', 'core' ),
		),
		'left-choice' => array(
			'value' => '_self',
			'label' => __( 'Self', 'core' ),
		),
	),
);

?>
