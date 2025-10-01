<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Team Member', 'core' ),
	'description'    => __( 'Add a Team Member', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'title_template' => '{{-title}}{{ if (o.name!="") { }}: {{-o.name}}{{ } }}',
);

?>
