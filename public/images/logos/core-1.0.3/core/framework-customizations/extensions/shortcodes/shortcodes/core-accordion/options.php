<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'panels' => array(
		'type'            => 'addable-popup',
		'label'           => __( 'Panels', 'core' ),
		'desc'            => __( 'Set of accordion panels.', 'core' ),
		'template'        => '{{if(title==""){}}' . __( 'Unnamed item', 'core' ) . '{{}else{}}{{-title}}{{}}}',
		'popup-title'     => __( 'Panel', 'core' ),
		'size'            => 'large',
		'limit'           => 10,
		'add-button-text' => __( 'Add', 'core' ),
		'sortable'        => true,
		'popup-options'   => array(

			'title' => array(
				'type'  => 'text',
				'label' => __( 'Title', 'core' ),
				'desc'  => __( 'Panel title.', 'core' ),
			),

			'icon' => array(
				'type'  => 'icon',
				'label' => __( 'Icon', 'core' ),
				'desc'  => __( 'Panel icon.', 'core' ),
			),

			'content' => array(
				'type'  => 'wp-editor',
				'label' => __( 'Content', 'core' ),
				'desc'  => __( 'Panel content.', 'core' ),
				'size'  => 'large',
			),
		),
	),
);

?>
