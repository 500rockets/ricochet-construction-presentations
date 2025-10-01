<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'title' => array(
		'type'  => 'text',
		'label' => __( 'Title', 'core' ),
		'desc'  => __( 'Pie chart title.', 'core' ),
	),

	'filling' => array(
		'type'       => 'slider',
		'value'      => 100,
		'properties' => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
		'label' => __( 'Filling', 'core' ),
		'desc'  => __( 'The filling of the pie chart in percentage.', 'core' ),
	),

	'color' => array(
		'type'   => 'multi-picker',
		'label'  => false,
		'desc'   => false,
		'value'  => array(),
		'picker' => array(
			'color_choice' => array(
				'type'    => 'radio',
				'value'   => 'brand',
				'label'   => __( 'Color', 'core' ),
				'desc'    => __( 'Choose color type for your pie chart.', 'core' ),
				'choices' => array(
					'brand'  => __( 'Brand', 'core' ),
					'custom' => __( 'Custom', 'core' ),
				),
				'inline' => true,
			),
		),
		'choices' => array(
			'custom' => array(
				'color' => array(
					'type'  => 'color-picker',
					'value' => _core_get_brand_color(),
					'label' => '',
					'desc'  => __( 'Choose your own color for your pie chart.', 'core' ),
				),
			),
		),
		'show_borders' => false,
	),
);

?>
