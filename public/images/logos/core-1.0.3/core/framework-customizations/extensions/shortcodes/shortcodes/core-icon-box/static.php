<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

// Enqueue all icon packs styles.
fw()->backend->option_type('icon-v2')->packs_loader->enqueue_frontend_css();

?>
