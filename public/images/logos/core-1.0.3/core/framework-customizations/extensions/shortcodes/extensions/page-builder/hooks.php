<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

/**
 * Remove page builder settings for Posts and Projects.
 *
 * @see _filter_core_remove_page_builder_posts_settings()
 */
add_filter( 'fw_ext_page_builder_supported_post_types', '_filter_core_remove_page_builder_posts_settings' );



/**
 * Remove page builder support for Posts and Projects.
 *
 * @see _action_core_remove_page_builder_posts_support()
 */
add_action( 'init', '_action_core_remove_page_builder_posts_support', 10000 );



/**
 * Change page builder content wrapper.
 *
 * @see _action_core_change_page_builder_content_wrapper()
 */
add_action( 'template_redirect', '_action_core_change_page_builder_content_wrapper' );



/**
 * @internal
 *
 * Remove page builder settings for Posts and Projects.
 */
function _filter_core_remove_page_builder_posts_settings( $supported ) {
	$post_types = array_keys( $supported );
	foreach ( $post_types as $slug ) {
		if ( $slug == 'post' || $slug == _core_get_portfolio_post_type_name() ) {
			unset( $supported[ $slug ] );
		}
	}
	return $supported;
}



/**
 * @internal
 *
 * Remove page builder support for Posts and Projects.
 */
function _action_core_remove_page_builder_posts_support() {
	$feature_name = fw_ext('page-builder')->get_supports_feature_name();
	$post_types   = array_keys( fw_get_db_ext_settings_option( 'page-builder', 'post_types' ) );
	foreach ( $post_types as $slug ) {
		if ( $slug == 'post' || $slug == _core_get_portfolio_post_type_name() ) {
			remove_post_type_support( $slug, $feature_name );
		}
	}
}



/**
 * @internal
 *
 * Change page builder content wrapper.
 *
 * @see _action_core_add_page_builder_content_wrapper()
 */
 function _action_core_change_page_builder_content_wrapper() {
	if ( is_page() && fw_ext('page-builder')->is_builder_post() ) {
		remove_filter( 'the_content', array( fw_ext('page-builder'), '_theme_filter_prevent_autop' ), 1 );
		add_filter( 'the_content', '_action_core_add_page_builder_content_wrapper', 1 );
	}
}



/**
 * @internal
 *
 * Wrap the content in a shortcode.
 *
 * @param string $content Current page content.
 */
function _action_core_add_page_builder_content_wrapper( $content ) {
	return '[core_content_wrapper]' . $content . '[/core_content_wrapper]';
}

?>
