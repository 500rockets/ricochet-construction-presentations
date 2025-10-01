<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'height' => array(
		'type'  => 'text',
		'value' => '50',
		'label' => __( 'Height', 'core' ),
		'desc'  => sprintf( '%s<br>%s<br>%s',
			__( 'Enter a pixel value.', 'core' ),
			__( 'Positive value will increase the whitespace, negative value will reduce it.', 'core' ),
			__( 'For example "50", "-25", "200".', 'core' )
		),
	),
);
