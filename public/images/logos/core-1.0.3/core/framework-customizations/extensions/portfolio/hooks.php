<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

/**
 * @internal
 *
 * Change projects per page.
 *
 * @param WP_Query[] $query Current WP Query object.
 */
function _action_core_change_portfolio_projects_per_page( $query ) {
	$taxonomy  = _core_get_portfolio_taxonomy_name();
	$post_type = _core_get_portfolio_post_type_name();
	$per_page  = core_get_portfolio_projects_per_page();
	if ( $query->is_main_query() && ! is_admin() && ( is_post_type_archive( $post_type ) || is_tax( $taxonomy ) ) ) {
		$query->set( 'posts_per_page', $per_page );
	}
}
add_action( 'pre_get_posts', '_action_core_change_portfolio_projects_per_page' );

?>
