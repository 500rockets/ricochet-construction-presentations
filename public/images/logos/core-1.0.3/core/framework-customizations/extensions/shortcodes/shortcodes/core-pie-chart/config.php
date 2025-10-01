<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Pie Chart', 'core' ),
	'description'    => __( 'Add a Pie Chart', 'core' ),
	'tab'            => __( 'Theme Elements', 'core' ),
	'title_template' => '{{-title}}: {{-o.filling}}&#37;',
);

?>
