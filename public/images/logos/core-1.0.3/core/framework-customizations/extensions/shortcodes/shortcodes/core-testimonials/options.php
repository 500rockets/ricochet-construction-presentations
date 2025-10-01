<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'type' => array(
		'type'    => 'radio',
		'value'   => 'standard',
		'label'   => __( 'Type', 'core' ),
		'desc'    => __( 'Type of the testimonials.', 'core' ),
		'choices' => array(
			'standard' => __( 'Standard', 'core' ),
			'card'     => __( 'Card', 'core' ),
		),
		'inline' => true,
	),

	'testimonials' => array(
		'type'            => 'addable-popup',
		'label'           => __( 'Testimonials', 'core' ),
		'desc'            => __( 'Set of testimonials.', 'core' ),
		'template'        => '{{=author}}',
		'popup-title'     => __( 'Testimonial', 'core' ),
		'size'            => 'large',
		'limit'           => 5,
		'add-button-text' => __( 'Add', 'core' ),
		'sortable'        => true,
		'popup-options'   => array(

			'author' => array(
				'type'  => 'text',
				'label' => __( 'Author', 'core' ),
				'desc'  => __( 'Author of the testimonial.', 'core' ),
				'help'  => __( 'If you leave this field blank, the testimonial will not be displayed.', 'core' ),
			),

			'text' => array(
				'type'  => 'textarea',
				'label' => __( 'Text', 'core' ),
				'desc'  => __( 'Text of the testimonial.', 'core' ),
				'help'  => __( 'If you leave this field blank, the testimonial will not be displayed.', 'core' ),
			),

			'image' => array(
				'type'  => 'background-image',
				'label' => __( 'Image', 'core' ),
				'desc'  => __( 'Image of the person.', 'core' ),
				'help'  => __( 'Used only with the Card type of testimonials.', 'core' ),
			),

			'job' => array(
				'type'  => 'text',
				'label' => __( 'Job', 'core' ),
				'desc'  => __( 'Job title of the person.', 'core' ),
				'help'  => __( 'Used only with the Card type of testimonials.', 'core' ),
			),
		),
	),
);

?>
