<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Heading', 'core' ),
	'description'    => __( 'Add a Heading', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'title_template' => '{{-title}}{{ if (o.title!="") { }}: {{-o.title}}{{ } }}',
);

?>
