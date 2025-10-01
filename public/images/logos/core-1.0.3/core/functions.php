<?php

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function core_theme_setup() {

	// Make theme available for translation.
	load_theme_textdomain( 'core', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Register navigation menus locations.
	register_nav_menus( array(
		'primary' => __( 'Main Menu', 'core' ),
	) );

	// Register a new image sizes.
	add_image_size( 'core-project-static', 770, 490, true );
	add_image_size( 'core-project-dynamic', 770, 840, false );

	// Style the visual editor.
	add_editor_style( 'editor-style.css' );
}
add_action( 'after_setup_theme', 'core_theme_setup' );



/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function core_content_width() {

	// Set content width.
	$GLOBALS['content_width'] = 1170;
}
add_action( 'after_setup_theme', 'core_content_width', 0 );



/**
 * Get google fonts URL.
 *
 * @return string Google fonts URL.
 */
function core_get_google_fonts_url() {

	// Define required fonts.
	$required_fonts = apply_filters( 'core_required_google_fonts', array(
		'families' => array(
			'Poppins' => array( '500', '600', '700' ),
			'Hind'    => array( 'regular', '700' ),
			'Lora'    => array( 'italic' ),
		),
		'subsets' => array( 'latin', 'latin-ext' ),
	) );

	// Convert families to string of the required format.
	foreach ( $required_fonts['families'] as $name => $variations ) {
		$required_fonts['families'][ $name ] = $name . ':' . implode( ',', $variations );
	}

	// Define URL parameters.
	$url_params = array(
		'family' => urlencode( implode( '|', $required_fonts['families'] ) ),
		'subset' => urlencode( implode( ',', $required_fonts['subsets'] ) ),
	);

	// Return Google fonts URL.
	return add_query_arg( $url_params, 'https://fonts.googleapis.com/css' );
}



/**
 * Get google maps URL.
 *
 * @return string Google maps URL.
 */
function core_get_google_maps_url() {

	// Define Google API key.
	$google_api_key = esc_html( apply_filters( 'core_google_maps_api_key', '' ) );

	// Define Google maps URL.
	$google_maps_url = ( $google_api_key != '' ) ? 'http://maps.googleapis.com/maps/api/js?key=' . $google_api_key : '';

	// Return Google maps URL.
	return $google_maps_url;
}



/**
 * Enqueue theme styles & scripts.
 *
 * @see core_get_google_fonts_url()
 * @see core_get_google_maps_url()
 */
function core_enqueue_theme_scripts() {

	// Custom fonts.
	wp_enqueue_style( 'core-google-fonts', core_get_google_fonts_url() );

	// Bootstrap framework.
	wp_enqueue_style( 'core-bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );

	// Plugins and icons styles.
	wp_enqueue_style( 'core-plugins-styles', get_template_directory_uri() . '/assets/css/plugins.min.css' );

	// Theme main styles.
	wp_enqueue_style( 'core-main-styles', get_template_directory_uri() . '/assets/css/template.min.css' );

	// Theme stylesheet.
	wp_enqueue_style( 'core-style', get_stylesheet_uri() );

	// Check the possibility of connecting scripts of comment reply.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		// Comment reply script.
		wp_enqueue_script( 'comment-reply' );
	}

	// Popper scripts.
	wp_enqueue_script( 'core-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js', array( 'jquery' ), false, true );

	// Bootstrap scripts.
	wp_enqueue_script( 'core-bootstrap', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array( 'jquery' ), false, true );

	// Google maps.
	wp_enqueue_script( 'core-google-maps', core_get_google_maps_url(), array( 'jquery' ), false, true );

	// Plugins scripts.
	wp_enqueue_script( 'core-plugins', get_template_directory_uri() . '/assets/js/plugins.min.js', array( 'jquery' ), false, true );

	// Theme main scripts.
	wp_enqueue_script( 'core-custom-scripts', get_template_directory_uri() . '/assets/js/custom.min.js', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'core_enqueue_theme_scripts' );



/**
 * Register a widget area.
 */
function core_widgets_init() {

	// Primary sidebar.
	$sidebar_args_1 = array(
		'name'          => __( 'Primary', 'core' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your primary area.', 'core' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title"><h5>',
		'after_title'   => '</h5></div>',
	);
	register_sidebar( $sidebar_args_1 );

	// Footer sidebar.
	$sidebar_args_2 = array(
		'name'          => __( 'Footer', 'core' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer area.', 'core' ),
		'before_widget' => '<div class="col-md-6 col-lg-3"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<div class="widget-title"><h5>',
		'after_title'   => '</h5></div>',
	);
	register_sidebar( $sidebar_args_2 );

	// Extra sidebar.
	$sidebar_args_3 = array(
		'name'          => __( 'Extra', 'core' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your extra side area.', 'core' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title"><h5>',
		'after_title'   => '</h5></div>',
	);
	register_sidebar( $sidebar_args_3 );
}
add_action( 'widgets_init', 'core_widgets_init' );



/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @param array $args Arguments for tag cloud widget.
 *
 * @return array New modified arguments.
 */
function core_custom_tag_cloud_widget_args( $args ) {

	// Set arguments values.
	$args['smallest'] = 8;
	$args['largest']  = 8;
	$args['unit']     = 'px';

	// Return new modified arguments.
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'core_custom_tag_cloud_widget_args' );



/**
 * Change the string displayed after a trimmed excerpt.
 *
 * @param string $more_string The string shown within the more link.
 *
 * @return string Modified string shown within the more link.
 */
function core_excerpt_more( $more_string ) {

	// Check if there is not admin area.
	if ( ! is_admin() ) {

		// Modifying default string.
		$more_string = '&hellip;';
	}

	// Return modified string.
	return $more_string;
}
add_filter( 'excerpt_more', 'core_excerpt_more' );



/**
 * Replace attachment link to media file to activate lightbox.
 *
 * @param string $link      The page link HTML output.
 * @param int    $id        Post ID.
 * @param string $size      Size of the image.
 * @param bool   $permalink Whether to add permalink to image. Default false.
 *
 * @return string Modified link HTML output.
 */
function core_replace_attachment_link( $link, $id, $size, $permalink ) {
	if ( ! $permalink ) {
		$link = str_replace( '<a href', '<a rel="gallery" href', $link );
	}
	return $link;
}
add_filter( 'wp_get_attachment_link', 'core_replace_attachment_link', 10, 4 );



/**
 * Get blog layout type.
 * Default type is classic.
 *
 * @return string Blog layout type.
 */
function core_get_blog_layout_type() {

	// Return blog layout type.
	return apply_filters( 'core_blog_layout_type', 'classic' );
}



/**
 * Get primary sidebar state.
 *
 * @return string Sidebar state.
 */
function core_get_sidebar_state() {

	// Check if blog sidebar is active.
	if ( is_active_sidebar( 'sidebar-1' ) ) {

		$sidebar_state = apply_filters( 'core_sidebar_state', 'sidebar-right' );

	// Blog sidebar is inactive.
	} else {

		$sidebar_state = 'no-sidebar';
	}

	// Return blog sidebar state.
	return $sidebar_state;
}



/**
 * Displays footer copyright content.
 */
function core_footer_copyright_content() {

	// Specifying the default content.
	$default_content =
	'<div class="text-center"><strong>' .
		'&#169; ' .
		date( 'Y' ) . ' ' .
		esc_html( get_bloginfo( 'name' ) ) . ', ' .
		esc_html__( 'All Rights Reserved.', 'core' ) .
	'</strong></div>';

	// Output content.
	echo apply_filters( 'core_footer_copyright_content', $default_content );
}



/**
 * Modify default pagination layout.
 *
 * @param string  $pagination Default pagination layout.
 * @param boolean $echo       Necessity of pagination output.
 *
 * @return string Modified pagination.
 */
function core_paginate_links( $pagination = '', $echo = true ) {

	// Check if default pagination is defined.
	if ( ! empty( $pagination ) && class_exists( 'DOMDocument' ) ) {

		// Create DOM object.
		$document = new DOMDocument;
		@$document->loadHTML( $pagination );

		// Get container from DOM object.
		if ( $container = $document->getElementsByTagName( 'ul' )->item( 0 ) ) {

			// Processing of each list item.
			foreach ( $container->getElementsByTagName( 'li' ) as $list_element ) {

				// Get link from list item.
				$link_element = $list_element->getElementsByTagName( '*' )->item( 0 );

				// Define list item classes.
				$list_classes = array( 'page-item' );

				// Define link classes.
				$link_classes = array_merge(
					array( 'page-link' ),
					explode( ' ', $link_element->getAttribute( 'class' ) )
				);

				// Set the classes to a list item, depending on the link classes.
				if ( in_array( 'current', $link_classes ) ) { $list_classes[] = 'active'; }
				if ( in_array( 'prev',    $link_classes ) ) { $list_classes[] = 'prev'; }
				if ( in_array( 'next',    $link_classes ) ) { $list_classes[] = 'next'; }

				// Set classes to list item and link.
				$list_element->setAttribute( 'class', implode( ' ', $list_classes ) );
				$link_element->setAttribute( 'class', implode( ' ', $link_classes ) );
			}

			// Set classes to container.
			$container->setAttribute( 'class', 'pagination h4' );

			// Redefine pagination.
			$pagination = $document->saveHTML( $container );
		}
	}

	// Check the need for output.
	if ( $echo ) {

		// Output modified pagination.
		echo $pagination;

	// The output is not needed.
	} else {

		// Return modified pagination.
		return $pagination;
	}
}



/**
 * Load a part into a template or get its contents.
 * Possible to pass variables to a template part.
 *
 * @param string  $path      Relative path to template part.
 * @param array   $variables Array of variables to extract.
 * @param boolean $return    Return contents.
 *
 * @return string The contents of the template part.
 */
function core_get_template_part( $path = '', $variables = array(), $return = false ) {

	// Check if the path without extension.
	if ( ! pathinfo( $path, PATHINFO_EXTENSION ) ) {

		// Add extension to path
		$path = $path . '.php';
	}

	// Search for template file.
	$full_path = locate_template( $path );

	// Template file found.
	if ( ! empty( $full_path ) ) {

		// Extract array of variables.
		extract( $variables, EXTR_SKIP );

		// Check that need to load the template.
		if ( ! $return ) {

			// Load template file.
			include( $full_path );

		// Need to return contents of the template.
		} else {

			// Return contents of the template file.
			ob_start();
			include( $full_path );
			return ob_get_clean();
		}
	}
}



/**
 * @internal
 *
 * Custom function to use to open and display each comment.
 *
 * @param WP_Comment[] $comment Comment data object.
 * @param array        $args    An array of arguments.
 * @param int          $depth   Depth of the current comment in reference to parents.
 */
function _core_comment_callback( $comment, $args, $depth ) { ?>
	<div id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
	<div class="comment-author">
		<?php echo get_avatar( $comment ); ?>
	</div>
	<div class="comment-body">
		<div class="comment-meta">
			<div class="comment-meta-author h5">
				<?php echo get_comment_author_link(); ?>
			</div>
			<div class="comment-meta-date">
				<a href="<?php echo esc_url( get_comment_link( $comment ) ); ?>">
					<?php printf( '%1$s, %2$s', get_comment_date(), get_comment_time() ); ?>
				</a>
				<?php edit_comment_link( '[' . esc_html__( 'Edit', 'core' ) . ']' ); ?>
			</div>
		</div>
		<div class="comment-content">
			<?php comment_text(); ?>
			<div class="clearfix"></div>
		</div>
		<div class="comment-reply">
			<?php comment_reply_link(
				array_merge( $args, array(
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
				) )
			); ?>
		</div>
	</div>

	<?php
	// Define the maximum comment indentation depth.
	$max_indent = 2;

	/**
	 * Check if comment has children and the depth of the
	 * comment does not exceed the maximum indentation depth.
	 */
	if ( $args['has_children'] == true && $depth < $max_indent ) {

		// Open the wrapper container of child comments.
		echo '<div class="children">';
	}
}



/**
 * @internal
 *
 * Custom function to use to close each comment.
 *
 * @param WP_Comment[] $comment Comment data object.
 * @param array        $args    An array of arguments.
 */
function _core_comment_callback_end( $comment, $args ) {

	// Define the maximum comment indentation depth.
	$max_indent = 2;

	/**
	 * Check if comment has children and the depth of the
	 * comment does not exceed the maximum indentation depth.
	 */
	if ( $args['has_children'] == true && $GLOBALS['comment_depth'] < $max_indent ) {

		// Close the wrapper container of child comments.
		echo '</div>';
	}

	// Close the wrapper container of current comment.
	echo '</div>';
}



/**
 * @internal
 *
 * Move the comment field to the end of the list of all fields in the comment form.
 *
 * @param array $comment_fields The comment fields.
 *
 * @return array Sorted comment fields.
 */
function _filter_core_sort_comment_form_fields( $comment_fields ) {
	if ( isset( $comment_fields['comment'] ) ) {
		$comment = $comment_fields['comment'];
		unset( $comment_fields['comment'] );
		$comment_fields['comment'] = $comment;
	}
	return $comment_fields;
}
add_filter( 'comment_form_fields', '_filter_core_sort_comment_form_fields' );



/**
 * @internal
 *
 * Wraps the comment form notes in the HTML container.
 *
 * @param array $defaults The default comment form arguments.
 *
 * @return array Modified comment form arguments.
 */
function _filter_core_wrap_comment_form_notes( $defaults ) {
	$notes = array( 'must_log_in', 'logged_in_as', 'comment_notes_before', 'comment_notes_after' );
	foreach( $notes as $name ) {
		if ( ! empty( $defaults[ $name ] ) ) {
			$defaults[ $name ] = '<div class="col-sm-12">' . $defaults[ $name ] . '</div>';
		}
	}
	return $defaults;
}
add_filter( 'comment_form_defaults', '_filter_core_wrap_comment_form_notes' );



/**
 * Add plugins.
 *
 * TGM Plugin Activation.
 * @link https://github.com/TGMPA/TGM-Plugin-Activation
 *
 * Theme Includes.
 * @link https://github.com/ThemeFuse/Theme-Includes
 */
require_once get_template_directory() . '/plugins/tgm-plugin-registration.php';
include_once get_template_directory() . '/includes/init.php';

?>
