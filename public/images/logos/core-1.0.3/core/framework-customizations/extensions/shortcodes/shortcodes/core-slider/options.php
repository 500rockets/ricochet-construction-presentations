<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'transition' => array(
		'type'    => 'short-select',
		'value'   => '',
		'label'   => __( 'Transition', 'core' ),
		'desc'    => __( 'Transition style of the slider.', 'core' ),
		'choices' => array(
			''          => __( 'Standard', 'core' ),
			'fade'      => __( 'Fade', 'core' ),
			'backSlide' => __( 'BackSlide', 'core' ),
			'goDown'    => __( 'GoDown', 'core' ),
			'fadeUp'    => __( 'FadeUp', 'core' ),
		),
	),

	'images' => array(
		'type'            => 'addable-option',
		'label'           => __( 'Images', 'core' ),
		'desc'            => __( 'Images for slider.', 'core' ),
		'option'          => array( 'type' => 'background-image' ),
		'add-button-text' => __( 'Add', 'core' ),
		'sortable'        => true,
	),
);

?>
