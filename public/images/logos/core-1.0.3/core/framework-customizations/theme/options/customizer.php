<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'sidebars_section' => array(
		'title'   => __( 'Sidebars', 'core' ),
		'options' => array(

			'primary_sidebar_section' => array(
				'title'   => __( 'Primary', 'core' ),
				'options' => array(

					'primary_sidebar_display' => array(
						'type'    => 'radio',
						'value'   => 'sidebar-right',
						'label'   => __( 'Display', 'core' ),
						'desc'    => __( 'Type of primary sidebar display.', 'core' ),
						'choices' => array(
							'sidebar-left'  => __( 'Left', 'core' ),
							'sidebar-right' => __( 'Right', 'core' ),
						),
						'inline' => true,
					),
				),
			),

			'extra_sidebar_section' => array(
				'title'   => __( 'Extra', 'core' ),
				'options' => array(

					'extra_sidebar_label' => array(
						'type'  => 'text',
						'label' => __( 'Label', 'core' ),
						'desc'  => __( 'Title of a button that opens an extra sidebar.', 'core' ),
						'help'  => __( 'Displayed only if the area has at least one widget.', 'core' ),
					),
				),
			),
		),
	),

	'blog_section' => array(
		'title'   => __( 'Blog', 'core' ),
		'options' => array(

			'blog_archive_section' => array(
				'title'   => __( 'Blog Archive', 'core' ),
				'options' => array(

					'blog_header' => array(
						'type'          => 'popup',
						'label'         => __( 'Page Header', 'core' ),
						'desc'          => __( 'Customize the contents and appearance of the page header.', 'core' ),
						'popup-title'   => __( 'Header Configuration', 'core' ),
						'button'        => __( 'Configure', 'core' ),
						'size'          => 'large',
						'popup-options' => array(

							'display' => array(
								'type'   => 'multi-picker',
								'label'  => false,
								'desc'   => false,
								'value'  => array(),
								'picker' => array(
									'display_choice' => array(
										'type'        => 'switch',
										'value'       => 'show',
										'label'       => __( 'Display', 'core' ),
										'desc'        => __( 'Show or hide the page header.', 'core' ),
										'left-choice' => array(
											'value' => 'hide',
											'label' => __( 'Hide', 'core' ),
										),
										'right-choice' => array(
											'value' => 'show',
											'label' => __( 'Show', 'core' ),
										),
									),
								),
								'choices' => array(
									'show' => _core_get_options_config( 'page-header' ),
								),
								'show_borders' => true,
							),
						),
					),

					'blog_layout_type' => array(
						'type'    => 'radio',
						'value'   => 'classic',
						'label'   => __( 'Layout Type', 'core' ),
						'desc'    => __( 'Layout type of the blog archive page.', 'core' ),
						'choices' => array(
							'classic' => __( 'Classic', 'core' ),
							'grid'    => __( 'Grid', 'core' ),
							'masonry' => __( 'Masonry', 'core' ),
						),
						'inline' => true,
					),
				),
			),
		),
	),

	'portfolio_section' => array(
		'title'   => __( 'Portfolio', 'core' ),
		'options' => array(

			'portfolio_project_section' => array(
				'title'   => __( 'Single Project', 'core' ),
				'options' => array(

					'additional_projects' => array(
						'type'          => 'popup',
						'label'         => __( 'Additional Projects', 'core' ),
						'desc'          => __( 'The block that displayed at the bottom of the single portfolio project page and contains some of the projects.', 'core' ),
						'popup-title'   => __( 'Block Configuration', 'core' ),
						'button'        => __( 'Configure', 'core' ),
						'size'          => 'small',
						'popup-options' => array(

							'show_projects' => array(
								'type'   => 'multi-picker',
								'label'  => false,
								'desc'   => false,
								'value'  => array(),
								'picker' => array(
									'display_choice' => array(
										'type'        => 'switch',
										'value'       => 'show',
										'label'       => __( 'Show', 'core' ),
										'desc'        => __( 'Show additional projects at the bottom of the single portfolio project page.', 'core' ),
										'left-choice' => array(
											'value' => 'hide',
											'label' => __( 'No', 'core' ),
										),
										'right-choice' => array(
											'value' => 'show',
											'label' => __( 'Yes', 'core' ),
										),
									),
								),
								'choices' => array(

									'show' => array(

										'title' => array(
											'type'  => 'text',
											'value' => __( 'Recent Works', 'core' ),
											'label' => __( 'Title', 'core' ),
											'desc'  => __( 'Enter the title of the additional projects block.', 'core' ),
										),

										'selection' => array(
											'type'   => 'multi-picker',
											'label'  => false,
											'desc'   => false,
											'value'  => array(),
											'picker' => array(
												'selection_type' => array(
													'type'    => 'radio',
													'value'   => 'recent',
													'label'   => __( 'Selection', 'core' ),
													'desc'    => __( 'Select the condition of a selection of additional projects.', 'core' ),
													'choices' => array(
														'recent' => __( 'Recent', 'core' ),
														'random' => __( 'Random', 'core' ),
														'custom' => __( 'Custom', 'core' ),
													),
													'inline' => true,
												),
											),
											'choices' => array(

												'custom' => array(

													'additional_projects_ids' => array(
														'type'       => 'multi-select',
														'value'      => '',
														'label'      => __( 'Projects', 'core' ),
														'desc'       => __( 'Select any portfolio projects.', 'core' ),
														'population' => 'posts',
														'source'     => 'fw-portfolio',
														'limit'      => 3,
													),
												),
											),
										),
									),
								),
							),
						),
					),

					'all_projects_page' => array(
						'type'   => 'multi-picker',
						'label'  => false,
						'desc'   => false,
						'value'  => array(),
						'picker' => array(
							'all_projects_page_type' => array(
								'type'    => 'radio',
								'value'   => 'archive',
								'label'   => __( 'All Projects Page', 'core' ),
								'desc'    => __( 'Page, the link to which will display at the bottom of the project page.', 'core' ),
								'choices' => array(
									'archive' => __( 'Archive', 'core' ),
									'custom'  => __( 'Custom', 'core' ),
								),
								'inline' => true,
							),
						),
						'choices' => array(

							'custom' => array(

								'all_projects_page_ids' => array(
									'type'       => 'multi-select',
									'value'      => '',
									'label'      => false,
									'desc'       => false,
									'population' => 'posts',
									'source'     => 'page',
									'limit'      => 1,
								),
							),
						),
						'show_borders' => false,
					),
				),
			),

			'portfolio_archive_section' => array(
				'title'   => __( 'Portfolio Archive', 'core' ),
				'options' => array(

					'portfolio_header' => array(
						'type'          => 'popup',
						'label'         => __( 'Page Header', 'core' ),
						'desc'          => __( 'Customize the contents and appearance of the page header.', 'core' ),
						'popup-title'   => __( 'Header Configuration', 'core' ),
						'button'        => __( 'Configure', 'core' ),
						'size'          => 'large',
						'popup-options' => array(

							'display' => array(
								'type'   => 'multi-picker',
								'label'  => false,
								'desc'   => false,
								'value'  => array(),
								'picker' => array(
									'display_choice' => array(
										'type'        => 'switch',
										'value'       => 'show',
										'label'       => __( 'Display', 'core' ),
										'desc'        => __( 'Show or hide the page header.', 'core' ),
										'left-choice' => array(
											'value' => 'hide',
											'label' => __( 'Hide', 'core' ),
										),
										'right-choice' => array(
											'value' => 'show',
											'label' => __( 'Show', 'core' ),
										),
									),
								),
								'choices' => array(
									'show' => _core_get_options_config( 'page-header' ),
								),
								'show_borders' => true,
							),
						),
					),

					'portfolio_layout_type' => array(
						'type'    => 'radio',
						'value'   => 'standard',
						'label'   => __( 'Layout Type', 'core' ),
						'desc'    => __( 'Layout type of the portfolio archive page.', 'core' ),
						'choices' => array(
							'standard' => __( 'Standard', 'core' ),
							'grid'     => __( 'Grid', 'core' ),
							'masonry'  => __( 'Masonry', 'core' ),
						),
						'inline' => true,
					),
				),
			),

			'portfolio_general_section' => array(
				'title'   => __( 'General', 'core' ),
				'options' => array(

					'projects_per_page' => array(
						'type'  => 'core-number',
						'value' => '6',
						'min'   => '6',
						'label' => __( 'Projects Per Page', 'core' ),
						'desc'  => __( 'The number of projects that will be shown when the page loads, and will be uploaded per one upload when you scroll the page.', 'core' ),
					),

					'layout_columns_count' => array(
						'type'    => 'short-select',
						'value'   => '3',
						'label'   => __( 'Columns Count', 'core' ),
						'desc'    => __( 'Number of columns of the current portfolio layout.', 'core' ),
						'choices' => array( '3' => '3', '4' => '4' ),
					),
				),
			),
		),
	),

	'fonts_section' => array(
		'title'   => __( 'Fonts', 'core' ),
		'options' => array(

			'basic_fonts_settings' => array(
				'type'  => 'popup',
				'label' => __( 'Basic Fonts', 'core' ),
				'desc'  => __( 'Configure the font face & style for the basic fonts.', 'core' ),
				'help'  => sprintf( '%1$s %2$s',
					__( 'If the font is not applied, check the language support on website.', 'core' ),
					'(<a target="_blank" href="https://fonts.google.com/">Google Fonts</a>)'
				),
				'popup-title'   => __( 'Fonts Configuration', 'core' ),
				'button'        => __( 'Configure', 'core' ),
				'size'          => 'small',
				'popup-options' => array(

					'general_font' => array(
						'type'  => 'typography-v2',
						'label' => __( 'General', 'core' ),
						'help'  => __( 'Applies to the main text content.', 'core' ),
						'attr'  => array( 'class' => 'core-hide-subset' ),
						'value' => array(
							'family'    => 'Hind',
							'variation' => 'regular',
							'subset'    => 'latin-ext',
						),
						'components' => array(
							'family'         => true,
							'size'           => false,
							'line-height'    => false,
							'letter-spacing' => false,
							'color'          => false,
						),
					),

					'primary_font' => array(
						'type'  => 'typography-v2',
						'label' => __( 'Primary', 'core' ),
						'help'  => __( 'Applies to the main design elements.', 'core' ),
						'attr'  => array( 'class' => 'core-hide-subset core-hide-variation core-hide-style core-hide-weight' ),
						'value' => array(
							'family'    => 'Poppins',
							'variation' => '600',
							'subset'    => 'latin-ext',
						),
						'components' => array(
							'family'         => true,
							'size'           => false,
							'line-height'    => false,
							'letter-spacing' => false,
							'color'          => false,
						),
					),

					'additional_font' => array(
						'type'  => 'typography-v2',
						'label' => __( 'Additional', 'core' ),
						'help'  => __( 'Applies to the some design elements.', 'core' ),
						'attr'  => array( 'class' => 'core-hide-subset' ),
						'value' => array(
							'family'    => 'Lora',
							'variation' => 'italic',
							'subset'    => 'latin-ext',
						),
						'components' => array(
							'family'         => true,
							'size'           => false,
							'line-height'    => false,
							'letter-spacing' => false,
							'color'          => false,
						),
					),
				),
			),
		),
	),

	'general_section' => array(
		'title'   => __( 'General', 'core' ),
		'options' => array(

			'brand_color' => array(
				'type'  => 'color-picker',
				'value' => '#4a90e2',
				'label' => __( 'Brand Color', 'core' ),
				'desc'  => __( 'Choose brand color for your website.', 'core' ),
			),

			'logo_settings' => array(
				'type'          => 'popup',
				'label'         => __( 'Logo Settings', 'core' ),
				'desc'          => __( 'Customize the contents and appearance of the logo.', 'core' ),
				'popup-title'   => __( 'Logo Configuration', 'core' ),
				'button'        => __( 'Configure', 'core' ),
				'size'          => 'small',
				'popup-options' => array(

					'logo_type' => array(
						'type'   => 'multi-picker',
						'label'  => false,
						'desc'   => false,
						'value'  => array(),
						'picker' => array(
							'type_choice' => array(
								'type'    => 'radio',
								'value'   => 'simple',
								'label'   => __( 'Type', 'core' ),
								'desc'    => __( 'Select the type of logo.', 'core' ),
								'choices' => array(
									'text'  => __( 'Text', 'core' ),
									'image' => __( 'Image', 'core' ),
								),
								'inline' => true,
							),
						),
						'choices' => array(

							'text' => array(

								'logo_content' => array(
									'type'  => 'text',
									'value' => esc_html( get_bloginfo( 'name' ) ),
									'label' => __( 'Content', 'core' ),
									'desc'  => __( 'Text content of the logo.', 'core' ),
								),

								'logo_font' => array(
									'type'  => 'typography-v2',
									'label' => __( 'Styles', 'core' ),
									'help'  => sprintf( '%1$s %2$s',
										__( 'If the font is not applied, check the language support on website.', 'core' ),
										'(<a target="_blank" href="https://fonts.google.com/">Google Fonts</a>)'
									),
									'attr'  => array( 'class' => 'core-hide-subset' ),
									'value' => array(
										'family'         => 'Raleway',
										'variation'      => '800',
										'size'           => '21',
										'letter-spacing' => '2.5',
										'subset'         => 'latin-ext',
									),
									'components' => array(
										'family'         => true,
										'size'           => true,
										'line-height'    => false,
										'letter-spacing' => true,
										'color'          => false,
									),
								),
							),

							'image' => array(

								'main_logo' => array(
									'type'  => 'background-image',
									'label' => __( 'Main', 'core' ),
									'desc'  => sprintf( '%s<br>%s',
										__( 'Main logo for your site.', 'core' ),
										__( 'Always displayed, unless you specify additional logo.', 'core' )
									),
								),

								'additional_logo' => array(
									'type'  => 'background-image',
									'label' => __( 'Additional', 'core' ),
									'desc'  => sprintf( '%s<br>%s<br>%s',
										__( 'Additional logo for your site.', 'core' ),
										__( 'Only appears on top of a dark page header.', 'core' ),
										__( 'This option makes sense to use when your main logo is lost against the dark page header.', 'core' )
									),
								),
							),
						),
					),
				),
			),

			'menu_alignment' => array(
				'type'    => 'radio',
				'value'   => 'header-center',
				'label'   => __( 'Menu Alignment', 'core' ),
				'desc'    => __( 'Select the main menu alignment.', 'core' ),
				'choices' => array(
					'header-left'   => __( 'Left', 'core' ),
					'header-center' => __( 'Center', 'core' ),
					'header-right'  => __( 'Right', 'core' ),
				),
				'inline' => true,
			),

			'page_footer' => array(
				'type'          => 'popup',
				'label'         => __( 'Footer Content', 'core' ),
				'desc'          => __( 'Customize the contents and appearance of the footer.', 'core' ),
				'popup-title'   => __( 'Footer Configuration', 'core' ),
				'button'        => __( 'Configure', 'core' ),
				'size'          => 'small',
				'popup-options' => array(

					'copyright' => array(
						'type'  => 'wp-editor',
						'value' => '<p style="text-align: center;"><strong>' .
							'&#169; ' .
							date( 'Y' ) . ' ' .
							esc_html( get_bloginfo( 'name' ) ) . ', ' .
							esc_html__( 'All Rights Reserved.', 'core' ) .
						'</strong></p>',
						'label' => __( 'Copyright', 'core' ),
						'desc'  => __( 'Text content, that appears in the copyright area of the footer.', 'core' ),
						'size'  => 'large',

						/**
						 * Limiting the capabilities of the editor
						 * due to the defective ordering of the stack
						 * of some WordPress and TinyMCE elements.
						 *
						 * Order of the stack of elements is corrected for 4.8.1 WP version.
						 * @link https://core.trac.wordpress.org/ticket/41158#no0
						 */
						'tinymce' => array(
							'toolbar1' => 'bold,italic,underline,strikethrough,alignleft,aligncenter,alignright,link,unlink,undo,redo',
						),
						'quicktags' => array(
							'buttons' => 'strong,em,link,close',
						),
						'media_buttons'    => false,
						'drag_drop_upload' => false,

						/**
						 * Fix the order of the stack of some
						 * WordPress and TinyMCE elements.
						 * Only needed in a customizer.
						 *
						 * Order of the stack of elements is corrected for 4.8.1 WP version.
						 * @link https://core.trac.wordpress.org/ticket/41158#no0
						 */
						'editor_css' => '<style type="text/css">' .
							'#wp-link-backdrop, div.mce-inline-toolbar-grp {' .
								'z-index: 500100;' .
							'}' .
							'#wp-link-wrap {' .
								'z-index: 500105;' .
							'}' .
						'</style>',
					),
				),
			),

			'google_maps_api_key' => array(
				'type'  => 'text',
				'label' => __( 'Google Maps API Key', 'core' ),
				'desc'  => sprintf( '%1$s %2$s',
					__( 'Create an application in Google Console and add the Key here.', 'core' ),
					'(<a target="_blank" href="https://console.developers.google.com/flows/enableapi?apiid=places_backend,maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend&keyType=CLIENT_SIDE&reusekey=true">Console</a>)'
				),
				'attr' => array( 'style' => 'font-size: 11px;' ),
			),
		),
	),
);

?>
