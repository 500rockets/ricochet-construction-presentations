<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Icon List', 'core' ),
	'description'    => __( 'Add an Icon List', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'popup_size'     => 'medium',
	'title_template' => '{{-title}}{{ if (o.icon_list.length>0) { }}: {{-o.icon_list.length}}{{ } }}',
);

?>
