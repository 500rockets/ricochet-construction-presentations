<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = _core_get_options_config( 'link' ) + array(

	'size' => array(
		'type'    => 'short-select',
		'value'   => 'btn-md',
		'label'   => __( 'Size', 'core' ),
		'desc'    => __( 'Choose size for your button.', 'core' ),
		'choices' => array(
			'btn-lg' => __( 'Large', 'core' ),
			'btn-md' => __( 'Standard', 'core' ),
			'btn-sm' => __( 'Medium', 'core' ),
			'btn-xs' => __( 'Small', 'core' ),
		),
	),

	'rounding' => array(
		'type'  => 'radio',
		'value' => 'btn-round',
		'label' => __( 'Rounding', 'core' ),
		'desc'  => __( 'Makes the corners of the button rounded.', 'core' ),
		'choices' => array(
			'btn-corner' => __( 'No', 'core' ),
			'btn-round'  => __( 'Low', 'core' ),
			'btn-circle' => __( 'High', 'core' ),
		),
		'inline' => true,
	),

	'style' => array(
		'type'    => 'checkboxes',
		'label'   => __( 'Style', 'core' ),
		'desc'    => __( 'Choose some styles for your button.', 'core' ),
		'choices' => array(
			'btn-outline' => __( 'Outline', 'core' ),
			'btn-shadow'  => __( 'Shadow', 'core' ),
			'btn-block'   => __( 'Block', 'core' ),
		),
		'inline' => true,
	),

	'color' => array(
		'type'    => 'short-select',
		'value'   => 'btn-brand',
		'label'   => __( 'Color', 'core' ),
		'desc'    => __( 'Choose a color for your button.', 'core' ),
		'choices' => array(
			'btn-brand'  => array(
				'text' => __( 'Brand', 'core' ),
			),
			'btn-dark'  => array(
				'text' => __( 'Dark', 'core' ),
			),
			'btn-gray' => array(
				'text' => __( 'Gray', 'core' ),
			),
			'btn-white' => array(
				'text' => __( 'White', 'core' ),
			),
		),
	),
);

?>
