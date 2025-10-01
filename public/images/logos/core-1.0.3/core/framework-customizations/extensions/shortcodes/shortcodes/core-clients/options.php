<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'type' => array(
		'type'    => 'radio',
		'value'   => 'grid',
		'label'   => __( 'Type', 'core' ),
		'desc'    => __( 'Type of the clients block.', 'core' ),
		'choices' => array(
			'grid'     => __( 'Grid', 'core' ),
			'carousel' => __( 'Carousel', 'core' ),
		),
		'inline' => true,
	),

	'items' => array(
		'type'       => 'slider',
		'value'      => 4,
		'properties' => array(
			'min'  => 1,
			'max'  => 4,
			'step' => 1,
		),
		'label' => __( 'Items', 'core' ),
		'desc'  => sprintf( '%s<br>%s',
			__( 'For a grid type, the number of items displayed in one row.', 'core' ),
			__( 'For a carousel type, the number of items displayed at once.', 'core' )
		),
	),

	'images' => array(
		'type'            => 'addable-option',
		'label'           => __( 'Images', 'core' ),
		'desc'            => __( 'Images for clients block.', 'core' ),
		'option'          => array( 'type' => 'background-image' ),
		'add-button-text' => __( 'Add', 'core' ),
		'sortable'        => true,
	),
);

?>
