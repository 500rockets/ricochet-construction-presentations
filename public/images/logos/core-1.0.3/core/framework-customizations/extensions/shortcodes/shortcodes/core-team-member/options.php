<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'image' => array(
		'type'  => 'background-image',
		'label' => __( 'Image', 'core' ),
		'desc'  => __( 'Image of the person.', 'core' ),
		'help'  => __( 'If you leave this field blank, the team member will not be displayed.', 'core' ),
	),

	'name' => array(
		'type'  => 'text',
		'label' => __( 'Name', 'core' ),
		'desc'  => __( 'Name of the person.', 'core' ),
	),

	'job' => array(
		'type'  => 'text',
		'label' => __( 'Job', 'core' ),
		'desc'  => __( 'Job title of the person.', 'core' ),
	),

	'social' => array(
		'type'            => 'addable-popup',
		'label'           => __( 'Social', 'core' ),
		'desc'            => __( 'Links to social network profiles of the person.', 'core' ),
		'template'        => '{{=icon_class.slice(6).replace(/-/g," ").replace(/\w\S*/g,function(f){return f.charAt(0).toUpperCase()+f.substr(1).toLowerCase()})}}',
		'popup-title'     => __( 'Social Link', 'core' ),
		'size'            => 'small',
		'limit'           => 5,
		'add-button-text' => __( 'Add', 'core' ),
		'sortable'        => true,
		'popup-options'   => array(

			'icon_class' => array(
				'type'  => 'icon',
				'label' => __( 'Icon', 'core' ),
				'desc'  => __( 'Link icon.', 'core' ),
			),

			'icon_link' => array(
				'type'  => 'text',
				'value' => '#',
				'label' => __( 'Link', 'core' ),
				'desc'  => __( 'Link URL.', 'core' ),
			),
		),
	),
);

?>
