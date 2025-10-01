<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Button', 'core' ),
	'description'    => __( 'Add a Button', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'popup_size'     => 'large',
	'title_template' => '{{-title}}{{ if (o.label!="") { }}: {{-o.label}}{{ } }}',
);

?>
