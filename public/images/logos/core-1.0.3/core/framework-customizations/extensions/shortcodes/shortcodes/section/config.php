<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$cfg = array();

$cfg['page_builder'] = array(
	'title'          => __( 'Section', 'core' ),
	'description'    => __( 'Add a Section', 'core' ),
	'tab'            => __( 'Layout Elements', 'core' ),
	'type'           => 'section',
	'popup_size'     => 'large',
	'title_template' => '{{-title}} {{' .
		'if (o.type["type_choice"]=="standard") {' .
			'}}: ' . __( 'Standard', 'core' ) . '{{' .
		'} else if (o.type["type_choice"]=="blog") {' .
			'}}: ' . __( 'Blog', 'core' ) . '{{' .
		'} else if (o.type["type_choice"]=="portfolio") {' .
			'}}: ' . __( 'Portfolio', 'core' ) . '{{' .
		'} else if (o.type["type_choice"]=="map") {' .
			'}}: ' . __( 'Map', 'core' ) . '{{' .
		'}' .
	'}}',
);
