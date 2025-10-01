<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Special Heading', 'core' ),
	'description'    => __( 'Add a Special Heading', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'title_template' => '{{-title}}{{ if (o.title!="") { }}: {{-o.title}}{{ } }}',
);

?>
