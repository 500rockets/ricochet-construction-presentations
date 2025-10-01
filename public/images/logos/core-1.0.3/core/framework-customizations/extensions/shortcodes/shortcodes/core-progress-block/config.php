<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Progress Block', 'core' ),
	'description'    => __( 'Add a Progress Block', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'title_template' => '{{-title}}{{ if (o.progress_bars.length>0) { }}: {{-o.progress_bars.length}}{{ } }}',
);

?>
