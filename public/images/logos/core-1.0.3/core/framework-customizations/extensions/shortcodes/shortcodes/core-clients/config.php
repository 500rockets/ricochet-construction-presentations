<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Clients', 'core' ),
	'description'    => __( 'Add a Clients Block', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'popup_size'     => 'medium',
	'title_template' => '{{-title}}{{ if (o.images.length>0) { }}: {{-o.images.length}}{{ } }}',
);

?>
