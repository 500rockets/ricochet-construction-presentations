<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = _core_get_options_config( 'button' ) + array(

	'alignment' => array(
		'type'    => 'radio',
		'value'   => 'text-left',
		'label'   => __( 'Alignment', 'core' ),
		'desc'    => __( 'Select the alignment of the button.', 'core' ),
		'choices' => array(
			'text-left'   => __( 'Left', 'core' ),
			'text-center' => __( 'Center', 'core' ),
			'text-right'  => __( 'Right', 'core' ),
		),
		'inline' => true,
	),
);

?>
