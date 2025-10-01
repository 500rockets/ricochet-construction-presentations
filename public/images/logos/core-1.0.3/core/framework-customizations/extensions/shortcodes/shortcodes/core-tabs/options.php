<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'alignment' => array(
		'type'    => 'radio',
		'value'   => 'justify-content-begin',
		'label'   => __( 'Position', 'core' ),
		'desc'    => __( 'Select the alignment of the tabs navigation.', 'core' ),
		'choices' => array(
			'justify-content-begin'  => __( 'Left', 'core' ),
			'justify-content-center' => __( 'Center', 'core' ),
			'justify-content-end'    => __( 'Right', 'core' ),
		),
		'inline' => true,
	),

	'tabs' => array(
		'type'            => 'addable-popup',
		'label'           => __( 'Panels', 'core' ),
		'desc'            => __( 'Set of tab panels.', 'core' ),
		'template'        => '{{if(title==""){}}' . __( 'Unnamed item', 'core' ) . '{{}else{}}{{-title}}{{}}}',
		'popup-title'     => __( 'Panel', 'core' ),
		'size'            => 'large',
		'limit'           => 5,
		'add-button-text' => __( 'Add', 'core' ),
		'sortable'        => true,
		'popup-options'   => array(

			'title' => array(
				'type'  => 'text',
				'label' => __( 'Title', 'core' ),
				'desc'  => __( 'Tab title.', 'core' ),
			),

			'icon' => array(
				'type'  => 'icon',
				'label' => __( 'Icon', 'core' ),
				'desc'  => __( 'Tab icon.', 'core' ),
			),

			'content' => array(
				'type'  => 'wp-editor',
				'label' => __( 'Content', 'core' ),
				'desc'  => __( 'Tab content.', 'core' ),
				'size'  => 'large',
			),
		),
	),
);

?>
