<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Accordion', 'core' ),
	'description'    => __( 'Add an Accordion', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'title_template' => '{{-title}}{{ if (o.panels.length>0) { }}: {{-o.panels.length}}{{ } }}',
);

?>
