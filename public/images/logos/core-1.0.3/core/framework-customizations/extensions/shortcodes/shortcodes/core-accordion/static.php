<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$uri = fw_get_template_customizations_directory_uri( '/extensions/shortcodes/shortcodes/core-accordion' );

wp_enqueue_style( 'core-shortcode-accordion', $uri . '/static/css/styles.css' );

?>
