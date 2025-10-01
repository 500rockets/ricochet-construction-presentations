<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Slider', 'core' ),
	'description'    => __( 'Add an Image Slider', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'popup_size'     => 'medium',
	'title_template' => '{{-title}}{{ if (o.images.length>0) { }}: {{-o.images.length}}{{ } }}',
);

?>
