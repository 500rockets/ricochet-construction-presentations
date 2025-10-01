<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Divider', 'core' ),
	'description'    => __( 'Add a Divider', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'popup_size'     => 'small',
	'title_template' => '{{-title}}{{ if (o.height!="") { }}: {{-o.height}}{{ } }}',
);

?>
