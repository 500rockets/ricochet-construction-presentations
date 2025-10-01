<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'price' => array(
		'type'  => 'short-text',
		'value' => '',
		'label' => __( 'Price', 'core' ),
		'desc'  => __( 'The price that displayed within the pricing table.', 'core' ),
	),

	'currency' => array(
		'type'  => 'icon',
		'value' => 'fa fa-dollar',
		'label' => __( 'Currency', 'core' ),
		'desc'  => __( 'Currency that displayed before the price.', 'core' ),
	),

	'title' => array(
		'type'  => 'text',
		'label' => __( 'Title', 'core' ),
		'desc'  => __( 'The title that displayed within the pricing table header.', 'core' ),
	),

	'subtitle' => array(
		'type'  => 'text',
		'label' => __( 'Subtitle', 'core' ),
		'desc'  => __( 'The subtitle that displayed within the pricing table header.', 'core' ),
	),

	'features' => array(
		'type'            => 'addable-popup',
		'label'           => __( 'Features', 'core' ),
		'desc'            => __( 'List of features that displayed within the pricing table.', 'core' ),
		'template'        => '{{if(decoration==false){}}{{-name}}{{}else{}}<s>{{-name}}</s>{{}}}',
		'popup-title'     => __( 'Feature Configuration', 'core' ),
		'size'            => 'small',
		'limit'           => 10,
		'add-button-text' => __( 'Add', 'core' ),
		'sortable'        => true,
		'popup-options'   => array(

			'name' => array(
				'type'  => 'text',
				'label' => __( 'Name', 'core' ),
				'desc'  => __( 'Short feature name.', 'core' ),
			),

			'decoration' => array(
				'type'  => 'checkbox',
				'value' => false,
				'label' => __( 'Decoration', 'core' ),
				'desc'  => __( 'Strikethrough feature text. ', 'core' ),
				'desc'  => sprintf( '%s<br>%s',
					__( 'Strikethrough feature name.', 'core' ),
					__( 'It can be useful if it is necessary to show that this feature is not available in the current pricing plan.', 'core' )
				),
				'text'  => __( 'Line through', 'core' ),
			),
		),
	),

	'style' => array(
		'type'    => 'checkboxes',
		'label'   => __( 'Style', 'core' ),
		'desc'    => __( 'Choose some styles for your pricing table.', 'core' ),
		'choices' => array(
			'pricing-popular'   => __( 'Special', 'core' ),
			'pricing-no-gutter' => __( 'Wide', 'core' ),
		),
		'inline' => true,
	),

	'button' => array(
		'type'   => 'multi-picker',
		'label'  => false,
		'desc'   => false,
		'value'  => array(),
		'picker' => array(
			'display_choice' => array(
				'type'        => 'switch',
				'value'       => 'hide',
				'label'       => __( 'Button', 'core' ),
				'desc'        => __( 'The button that displayed within the pricing table.', 'core' ),
				'left-choice' => array(
					'value' => 'hide',
					'label' => __( 'Hide', 'core' ),
				),
				'right-choice' => array(
					'value' => 'show',
					'label' => __( 'Show', 'core' ),
				),
			),
		),
		'choices' => array(
			'show' => _core_get_options_config( 'button' ),
		),
		'show_borders' => false,
	),
);

?>
