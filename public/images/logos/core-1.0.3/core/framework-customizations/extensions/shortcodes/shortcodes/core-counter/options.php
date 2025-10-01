<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'title' => array(
		'type'  => 'text',
		'label' => __( 'Title', 'core' ),
		'desc'  => __( 'Counter title.', 'core' ),
	),

	'number' => array(
		'type'  => 'core-number',
		'value' => '0',
		'min'   => '0',
		'label' => __( 'Number', 'core' ),
		'desc'  => __( 'The number of the counter.', 'core' ),
	),
);

?>
