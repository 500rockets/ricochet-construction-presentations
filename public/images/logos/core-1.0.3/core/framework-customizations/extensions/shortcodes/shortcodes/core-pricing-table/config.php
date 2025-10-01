<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Pricing Table', 'core' ),
	'description'    => __( 'Add a Pricing Table', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'popup_size'     => 'large',
	'title_template' => '{{-title}}{{ if (o.title!="") { }}: {{-o.title}}{{ } }}',
);

?>
