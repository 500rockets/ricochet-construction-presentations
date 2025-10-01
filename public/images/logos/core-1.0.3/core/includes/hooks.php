<?php

/**
 * Any action taken when installed and activated the Unyson plugin.
 *
 * @link https://github.com/ThemeFuse/Unyson
 */
if ( defined( 'FW' ) ) {

	/**
	 * @internal
	 *
	 * Enqueue admin styles.
	 */
	function _action_core_enqueue_admin_styles() {
		$styles_url = get_template_directory_uri() . '/includes/static/css/admin-styles.css';
		wp_enqueue_style( 'core-admin-styles', $styles_url );
	}
	add_action( 'admin_enqueue_scripts', '_action_core_enqueue_admin_styles', 20 );



	/**
	 * @internal
	 *
	 * Include custom options types.
	 */
	function _action_core_include_custom_option_types() {
		require_once dirname(__FILE__) . '/options/types/core-number/class-core-option-type-number.php';
	}
	add_action( 'fw_option_types_init', '_action_core_include_custom_option_types' );



	/**
	 * @internal
	 *
	 * Add custom icons pack (Linea Icons) to select in the "Icon v2" option.
	 *
	 * @param array $default_packs Icon packs set.
	 *
	 * @return array Updated icon packs set.
	 */
	function _filter_core_add_linea_icons_pack( $default_packs ) {
		return array(
			'linea_icons' => array(
				'name'             => 'linea_icons',
				'title'            => 'Linea',
				'css_class_prefix' => 'icon',
				'css_file'         => get_template_directory() . '/assets/css/linea-icons.css',
				'css_file_uri'     => get_template_directory_uri() . '/assets/css/linea-icons.css',
			),
		);
	}
	add_filter( 'fw:option_type:icon-v2:packs', '_filter_core_add_linea_icons_pack' );



	/**
	 * @internal
	 *
	 * Set blog layout type.
	 *
	 * @param string $default_type Default blog layout type.
	 *
	 * @return string Blog layout type.
	 */
	function _filter_core_blog_layout_type( $default_type ) {
		$layout_type = fw_get_db_customizer_option( 'blog_layout_type' );
		if ( empty( $layout_type ) ) {
			$layout_type = $default_type;
		}
		return $layout_type;
	}
	add_filter( 'core_blog_layout_type', '_filter_core_blog_layout_type' );



	/**
	 * @internal
	 *
	 * Set type of primary sidebar display.
	 *
	 * @param string $display_type Default type of sidebar display.
	 *
	 * @return string Type of sidebar display.
	 */
	function _filter_core_sidebar_state( $display_type ) {
		$option_value = fw_get_db_customizer_option( 'primary_sidebar_display' );
		if ( ! empty( $option_value ) ) {
			$display_type = $option_value;
		}
		return $display_type;
	}
	add_filter( 'core_sidebar_state', '_filter_core_sidebar_state' );



	/**
	 * @internal
	 *
	 * Set label of a button that opens an extra sidebar.
	 *
	 * @param string $label Default label.
	 *
	 * @return string Label of a button.
	 */
	function _filter_core_extra_sidebar_label( $label ) {
		$option_value = fw_get_db_customizer_option( 'extra_sidebar_label' );
		if ( ! empty( $option_value ) ) {
			$label = $option_value;
		}
		return $label;
	}
	add_filter( 'core_extra_sidebar_label', '_filter_core_extra_sidebar_label' );



	/**
	 * @internal
	 *
	 * Get google maps API key.
	 *
	 * @see _core_get_google_maps_api_key()
	 *
	 * @return string Google Maps API key.
	 */
	function _filter_core_google_maps_api_key() {
		return esc_html( _core_get_google_maps_api_key() );
	}
	add_filter( 'core_google_maps_api_key', '_filter_core_google_maps_api_key' );



	/**
	 * @internal
	 *
	 * Set an alignment of navigation menu.
	 *
	 * @param string $alignment Default alignment.
	 *
	 * @return string Menu alignment.
	 */
	function _filter_core_navigation_menu_alignment( $alignment ) {
		$alignment_option = fw_get_db_customizer_option( 'menu_alignment' );
		if ( ! empty( $alignment_option ) ) {
			$alignment = $alignment_option;
		}
		return $alignment;
	}
	add_filter( 'core_navigation_menu_alignment', '_filter_core_navigation_menu_alignment' );



	/**
	 * @internal
	 *
	 * Set a specific navigation menu for a specific page.
	 *
	 * @param string $menu Default menu.
	 *
	 * @return string Menu ID
	 */
	function _filter_core_special_navigation_menu( $menu ) {
		if ( is_page() ) {
			$menu_option = fw_get_db_post_option( get_the_ID(), 'special_navigation_menu' );
			if ( ! empty( $menu_option ) && $menu_option != 'default' ) {
				$menu_data = explode( '_', $menu_option );
				$menu_id   = $menu_data[1];
				if ( in_array( $menu_id, wp_get_nav_menus( array( 'fields' => 'ids' ) ) ) ) {
					$menu = $menu_id;
				}
			}
		}
		return $menu;
	}
	add_filter( 'core_special_navigation_menu', '_filter_core_special_navigation_menu' );



	/**
	 * @internal
	 *
	 * Get the logo content depending on the options values.
	 *
	 * @param string $content Default content.
	 *
	 * @return string Logo content.
	 */
	function _filter_core_brand_logo_content( $content ) {
		$logo_option = fw_get_db_customizer_option( 'logo_settings/logo_type' );
		$logo_type   = fw_akg( 'type_choice', $logo_option );
		if ( $logo_type == 'text' ) {
			$content = esc_html( fw_akg( 'text/logo_content', $logo_option ) );
		} elseif ( $logo_type == 'image' ) {
			$main_logo_url       = fw_akg( 'image/main_logo/data/icon', $logo_option );
			$additional_logo_url = fw_akg( 'image/additional_logo/data/icon', $logo_option );
			if ( ! empty( $main_logo_url ) ) {
				$content = '';
				if ( empty( $additional_logo_url ) ) { $additional_logo_url = $main_logo_url; }
				$logo_attributes = array(
					'main' => array(
						'class' => 'brand-dark',
						'src'   => $main_logo_url,
					),
					'additional' => array(
						'class' => 'brand-light',
						'src'   => $additional_logo_url,
					),
				);
				foreach ( $logo_attributes as $attr ) {
					$content .= fw_html_tag( 'img', $attr, false );
				}
			}
		}
		return $content;
	}
	add_filter( 'core_brand_logo_content', '_filter_core_brand_logo_content' );



	/**
	 * @internal
	 *
	 * Get the footer copyright content depending on the options values.
	 *
	 * @param string $content Default content.
	 *
	 * @return string Footer copyright content.
	 */
	function _filter_core_footer_copyright_content( $content ) {
		$footer_configuration = fw_get_db_customizer_option( 'page_footer' );
		if ( ! empty( $footer_configuration ) ) {
			$content = wp_kses_post( fw_akg( 'copyright', $footer_configuration ) );
		}
		return $content;
	}
	add_filter( 'core_footer_copyright_content', '_filter_core_footer_copyright_content' );



	/**
	 * @internal
	 *
	 * Get required google fonts.
	 *
	 * @param array $default_fonts Default font families and subsets.
	 *
	 * @return array Required font families and subsets.
	 */
	function _filter_core_required_google_fonts( $default_fonts ) {
		$extra_variations = array(
			'general_font' => true,
			'primary_font' => true,
		);
		return _core_get_required_google_fonts( _core_get_fonts_settings(), $extra_variations );
	}
	add_filter( 'core_required_google_fonts', '_filter_core_required_google_fonts' );



	/**
	 * @internal
	 *
	 * Enqueue inline fonts styles.
	 *
	 * @see _core_get_inline_fonts_styles()
	 * @see _core_get_fonts_settings()
	 * @see core_prepare_inline_styles()
	 */
	function _action_core_enqueue_inline_fonts_styles() {
		$style_elements = array(
			'general_font' => array(
				'body',
			),
			'primary_font' => array(
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
				'.h1',
				'.h2',
				'.h3',
				'.h4',
				'.h5',
				'.h6',
				'.form-control',
				'.btn',
				'.header',
				'.widget input',
				'.widget select',
				'.widget_nav_menu ul li',
			),
			'additional_font' => array(
				'.font-serif',
				'blockquote',
			),
			'logo_font' => array(
				'a.inner-brand',
			),
		);
		$exclude_components  = array( 'primary_font' => array( 'style', 'weight' ) );
		$inline_fonts_styles = _core_get_inline_fonts_styles(
			_core_get_fonts_settings(),
			$style_elements,
			$exclude_components
		);
		wp_add_inline_style( 'core-main-styles', core_prepare_inline_styles( $inline_fonts_styles ) );
	}
	add_action( 'wp_enqueue_scripts', '_action_core_enqueue_inline_fonts_styles' );



	/**
	 * @internal
	 *
	 * Enqueue inline color styles.
	 *
	 * @see core_prepare_inline_styles()
	 */
	function _action_core_enqueue_inline_color_styles() {
		$bc_hex   = _core_get_brand_color();
		$bc_rgb   = implode( ', ', core_hex2rgb( $bc_hex ) );
		$bc_rl_8  = core_reduce_color_lightness( $bc_hex, 8 );
		$bc_rl_10 = core_reduce_color_lightness( $bc_hex, 10 );
		$bc_il_10 = core_increace_color_lightness( $bc_hex, 10 );

		$inline_color_styles =
		'::-moz-selection {
			background: ' . $bc_hex . ';
			color: #fff !important;
		}
		::-webkit-selection {
			background: ' . $bc_hex . ';
			color: #fff !important;
		}
		::selection {
			background: ' . $bc_hex . ';
			color: #fff !important;
		}
		a {
			color: ' . $bc_hex . ';
		}
		h1 > a:hover,
		h1 > a:focus,
		h2 > a:hover,
		h2 > a:focus,
		h3 > a:hover,
		h3 > a:focus,
		h4 > a:hover,
		h4 > a:focus,
		h5 > a:hover,
		h5 > a:focus,
		h6 > a:hover,
		h6 > a:focus {
			color: ' . $bc_hex . ';
		}
		a:hover,
		a:focus {
			color: ' . $bc_rl_10 . ';
		}
		blockquote:hover {
			border-color: ' . $bc_hex . ';
		}
		.alert-brand {
			background: ' . $bc_il_10 . ';
		}
		.icon-box-icon,
		.icon-box-left .icon-box-icon,
		.counter .counter-number,
		.icon-list .fa,
		.icon-list .icon,
		.breadcrumb-item > a:hover,
		.breadcrumb-item > a:focus,
		.page-item.active .page-link,
		.page-link:focus,
		.page-link:hover,
		.social-icons > li > a:hover,
		.social-icons > li > a:focus,
		.comment-meta-author a:hover,
		.comment-meta-author a:focus,
		.comment-meta-date a:hover,
		.comment-meta-date a:focus,
		.ps-all a:hover,
		.ps-next a:hover,
		.ps-prev a:hover,
		.widget a:hover,
		.widget a:focus,
		.search-button:hover,
		.post-meta a:hover,
		.post-meta a:focus,
		.product-rating a:hover {
			color: ' . $bc_hex . ';
		}
		.btn.btn-brand {
			background-color: ' . $bc_hex . ';
			border-color: ' . $bc_hex . ';
		}
		.btn.btn-brand:hover,
		.btn.btn-brand:focus {
			background-color: ' . $bc_rl_8 . ';
			border-color: ' . $bc_rl_8 . ';
		}
		.btn.btn-brand.btn-outline {
			background: transparent;
			border-color: ' . $bc_hex . ';
			color: ' . $bc_hex . ';
		}
		.btn.btn-brand.btn-outline:hover,
		.btn.btn-brand.btn-outline:focus {
			background: ' . $bc_hex . ';
		}
		.btn.btn-white:hover,
		.btn.btn-white:focus {
			background-color: ' . $bc_hex . ';
			border-color: ' . $bc_hex . ';
		}
		.btn.btn-white.btn-outline {
			background: transparent;
			border-color: #fff;
			color: #fff;
		}
		.btn.btn-white.btn-outline:hover,
		.btn.btn-white.btn-outline:focus {
			background: #fff;
			color: #444;
		}
		.scroll-top,
		.label-brand,
		.pace .pace-progress,
		.post-tags a:hover,
		.comment-reply > a:hover,
		.comment-reply > a:focus,
		.widget_tag_cloud .tagcloud > a:hover {
			background: ' . $bc_hex . ';
		}
		.progress-bar.progress-bar-brand {
			background-color: ' . $bc_hex . ';
		}
		.special-heading h1,
		.special-heading h2,
		.special-heading h3,
		.special-heading h4,
		.special-heading h5,
		.special-heading h6 {
			border-color: ' . $bc_hex . ';
		}
		.footer .widget_tag_cloud .tagcloud > a:hover,
		.off-canvas-cart .widget_tag_cloud .tagcloud > a:hover {
			background-color: ' . $bc_hex . ';
			border-color: ' . $bc_hex . ';
		}
		.footer a:hover,
		.footer a:focus {
			color: #fff;
			opacity: .7;
		}
		.bg-gradient:after {
			background-color: ' . $bc_hex . ';
			background: -webkit-linear-gradient(45deg, ' . $bc_hex . ' 0%, rgba(' . $bc_rgb . ', .3) 100%);
			background: linear-gradient(45deg, ' . $bc_hex . ' 0%, rgba(' . $bc_rgb . ', .3) 100%);
		}';
		wp_add_inline_style( 'core-main-styles', core_prepare_inline_styles( $inline_color_styles ) );
	}
	add_action( 'wp_enqueue_scripts', '_action_core_enqueue_inline_color_styles' );
}

?>
