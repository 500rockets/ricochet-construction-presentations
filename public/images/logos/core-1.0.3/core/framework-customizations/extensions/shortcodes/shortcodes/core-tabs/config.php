<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Tabs', 'core' ),
	'description'    => __( 'Add some Tabs', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'title_template' => '{{-title}}{{ if (o.tabs.length>0) { }}: {{-o.tabs.length}}{{ } }}',
);

?>
