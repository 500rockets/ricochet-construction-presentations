<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Counter', 'core' ),
	'description'    => __( 'Add a Counter', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'title_template' => '{{-title}}{{ if (o.title!="") { }}: {{-o.title}}{{ } }}',
);

?>
