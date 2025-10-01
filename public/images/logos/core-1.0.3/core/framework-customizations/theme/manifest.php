<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$manifest['supported_extensions'] = array(
	'portfolio'    => array(),
	'page-builder' => array(),
	'breadcrumbs'  => array(),
	'megamenu'     => array(),
	'backups'      => array(),
);

$manifest['requirements'] = array(
	'wordpress' => array(
		'min_version' => '4.7.3',
	),
	'framework' => array(
		'min_version' => '2.7.6',
	),
);

?>
