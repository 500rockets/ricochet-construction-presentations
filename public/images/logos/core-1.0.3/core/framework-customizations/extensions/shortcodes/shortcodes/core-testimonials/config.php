<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Testimonials', 'core' ),
	'description'    => __( 'Add some Testimonials', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'title_template' => '{{-title}}{{ if (o.testimonials.length>0) { }}: {{-o.testimonials.length}}{{ } }}',
);

?>
