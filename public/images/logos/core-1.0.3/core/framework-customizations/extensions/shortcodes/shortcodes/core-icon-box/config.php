<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Icon Box', 'core' ),
	'description'    => __( 'Add an Icon Box', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'popup_size'     => 'large',
	'title_template' => '{{-title}}{{ if (o.title!="") { }}: {{-o.title}}{{ } }}',
);

?>
