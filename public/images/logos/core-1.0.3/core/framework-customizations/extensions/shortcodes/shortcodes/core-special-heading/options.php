<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'title' => array(
		'type'  => 'text',
		'label' => __( 'Title', 'core' ),
		'desc'  => __( 'Enter the heading title.', 'core' ),
	),

	'subtitle' => array(
		'type'  => 'textarea',
		'label' => __( 'Subtitle', 'core' ),
		'desc'  => __( 'Enter the heading subtitle.', 'core' ),
		'help'  => __( 'You can use line breaks.', 'core' ),
		'attr' => array( 'rows' => '3' ),
	),

	'alignment' => array(
		'type'    => 'radio',
		'value'   => 'text-center',
		'label'   => __( 'Position', 'core' ),
		'desc'    => __( 'Select the alignment of the heading.', 'core' ),
		'choices' => array(
			'text-left'   => __( 'Left', 'core' ),
			'text-center' => __( 'Center', 'core' ),
			'text-right'  => __( 'Right', 'core' ),
		),
		'inline' => true,
	),
);

?>
