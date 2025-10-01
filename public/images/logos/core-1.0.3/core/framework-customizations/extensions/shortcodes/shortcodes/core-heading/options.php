<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'title' => array(
		'type'  => 'text',
		'value' => '',
		'label' => __( 'Title', 'core' ),
		'desc'  => __( 'Enter the heading title.', 'core' ),
	),

	'size' => array(
		'type'    => 'select',
		'label'   => __( 'Size', 'core' ),
		'desc'    => __( 'Select the size of the heading.', 'core' ),
		'help'    => __( 'First the largest, sixth the smallest.', 'core' ),
		'value'   => 'h3',
		'choices' => array(
			'h1' => 'H1',
			'h2' => 'H2',
			'h3' => 'H3',
			'h4' => 'H4',
			'h5' => 'H5',
			'h6' => 'H6',
		),
	),

	'special' => array(
		'type'  => 'switch',
		'value' => '',
		'label' => __( 'Special', 'core' ),
		'desc'  => __( 'Applying a special heading style.', 'core' ),
		'right-choice' => array(
			'value' => 'special-heading',
			'label' => __( 'Yes', 'core' ),
		),
		'left-choice' => array(
			'value' => '',
			'label' => __( 'No', 'core' ),
		),
	),
);

?>
