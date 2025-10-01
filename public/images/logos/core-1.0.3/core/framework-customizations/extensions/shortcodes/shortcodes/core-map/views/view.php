<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

// Specifying the initial settings.
$map_layout  = '';
$map_content = '';

$locations_option = $atts['locations'];
$map_zoom         = $atts['zoom'] + 10;

$position_list    = array();
$description_list = array();

// Check to see if at least one set of coordinates.
if ( ! empty( $locations_option ) ) {

	foreach ( $locations_option as $location ) {

		$location_position    = $location['position'];
		$location_description = preg_replace( '/\r|\n/', '', nl2br( $location['description'] ) );

		if ( ! empty( $location_position ) ) {
			$position_list[]    = '[' . $location_position . ']';
			$description_list[] = '[' . $location_description . ']';
		}
	}
}

$position_list    = ( ! empty( $position_list ) ) ? implode( ',', $position_list ) : '[]';
$description_list = ( ! empty( $description_list ) ) ? implode( ',', $description_list ) : '[]';

if ( _core_get_google_maps_api_key() ) {

	// Define the HTML layout of the section content.
	$map_content =
	'<div class="map" ' .
		'data-addresses="' . esc_attr( $position_list ) . '" ' .
		'data-info="' . esc_attr( $description_list ) . '" ' .
		'data-icon="' . get_template_directory_uri() . '/assets/images/map-icon.png" ' .
		'data-zoom="' . $map_zoom . '">' .
	'</div>';
}

// Define the HTML layout of the map.
$map_layout = '<div class="maps-container map-widget module-gray">' . $map_content . '</div>';

// Output the HTML layout of the section block.
echo $map_layout;

?>
