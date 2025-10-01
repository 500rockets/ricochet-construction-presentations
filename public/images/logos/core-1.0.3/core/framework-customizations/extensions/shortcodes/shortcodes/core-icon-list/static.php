<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$uri = fw_get_template_customizations_directory_uri( '/extensions/shortcodes/shortcodes/core-icon-list' );

wp_enqueue_style( 'core-shortcode-icon-list', $uri . '/static/css/styles.css' );

// Enqueue all icon packs styles.
fw()->backend->option_type('icon-v2')->packs_loader->enqueue_frontend_css();

?>
