<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Map', 'core' ),
	'description'    => __( 'Add a Map', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'title_template' => '{{-title}}{{ if (o.locations.length>0) { }}: {{-o.locations.length}}{{ } }}',
);

?>
