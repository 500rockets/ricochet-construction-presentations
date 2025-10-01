<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'locations' => array(
		'type'  => 'addable-popup',
		'label' => __( 'Locations', 'core' ),
		'desc'  => sprintf( '%s<br>%s',
			__( 'Set of locations that will be marked on the map.', 'core' ),
			__( 'The first location is the center of the map.', 'core' )
		),
		'template'        => '{{=position}}',
		'popup-title'     => __( 'Location', 'core' ),
		'size'            => 'small',
		'limit'           => 5,
		'add-button-text' => __( 'Add', 'core' ),
		'sortable'        => true,
		'popup-options'   => array(

			'position' => array(
				'type'  => 'text',
				'label' => __( 'Position', 'core' ),
				'desc'  => sprintf( '%s<br>%s',
					__( 'Enter the location position in latitude and longitude.', 'core' ) .
					' (<a target="_blank" href="http://www.latlong.net/">LatLong</a>)',
					__( 'For example "33.995453, -118.476396".', 'core' )
				),
			),

			'description' => array(
				'type'  => 'textarea',
				'label' => __( 'Description', 'core' ),
				'desc'  => __( 'Location description.', 'core' ),
				'help'  => __( 'You can use line breaks.', 'core' ),
			),
		),
	),

	'zoom' => array(
		'type'       => 'slider',
		'value'      => 6,
		'properties' => array(
			'min'  => 0,
			'max'  => 10,
			'step' => 1,
		),
		'label' => __( 'Zoom', 'core' ),
		'desc'  => __( 'Initial map zoom.', 'core' ),
	),
);

?>
