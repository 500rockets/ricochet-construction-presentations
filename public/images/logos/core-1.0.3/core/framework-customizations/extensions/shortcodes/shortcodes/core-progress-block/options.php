<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'progress_bars' => array(
		'type'            => 'addable-popup',
		'label'           => __( 'Progress Bars', 'core' ),
		'desc'            => __( 'Set of progress bars.', 'core' ),
		'template'        => '{{=progress_title}}, {{=progress_filling}}%',
		'template'        => '{{if(title==""){}}{{}else{}}{{=title}}, {{=filling}}%{{}}}',
		'popup-title'     => __( 'Progress Bar', 'core' ),
		'size'            => 'medium',
		'limit'           => 10,
		'add-button-text' => __( 'Add', 'core' ),
		'sortable'        => true,
		'popup-options'   => array(

			'title' => array(
				'type'  => 'text',
				'label' => __( 'Title', 'core' ),
				'desc'  => __( 'Progress bar title.', 'core' ),
				'help'  => __( 'If you leave this field blank, the progress bar will not be displayed.', 'core' ),
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
				'desc'  => __( 'The filling of the progress bar in percentage.', 'core' ),
			),

			'striped' => array(
				'type'        => 'switch',
				'value'       => '',
				'label'       => __( 'Striped', 'core' ),
				'desc'        => __( 'Activates the moving strips on the progress bar.', 'core' ),
				'left-choice' => array(
					'value' => 'progress-bar-solid',
					'label' => __( 'No', 'core' ),
				),
				'right-choice' => array(
					'value' => 'progress-bar-striped progress-bar-animated',
					'label' => __( 'Yes', 'core' ),
				),
			),
		),
	),
);

?>
