<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Contact Form', 'core' ),
	'description'    => __( 'Add a Contact Form', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'title_template' => '{{-title}}{{ if (o.form_kind!="" && o.form_kind!="none") { }}: {{-o.form_kind.replace(/form_/g,"ID ")}}{{ } }}',
);

?>
