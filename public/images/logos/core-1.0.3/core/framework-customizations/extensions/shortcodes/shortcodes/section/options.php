<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

// Appearance options configuration for shortcode.
$appearance_options = array(

	'width' => array(
		'type'    => 'radio',
		'value'   => 'container',
		'label'   => __( 'Width', 'core' ),
		'desc'    => __( 'The width of the section.', 'core' ),
		'choices' => array(
			'container'       => __( 'Default', 'core' ),
			'container-fluid' => __( 'Full Width', 'core' ),
		),
		'inline' => true,
	),

	'indents' => array(
		'type'   => 'multi-picker',
		'label'  => false,
		'desc'   => false,
		'value'  => array(),
		'picker' => array(
			'indents_type' => array(
				'type'    => 'radio',
				'value'   => 'module',
				'label'   => __( 'Indents', 'core' ),
				'desc'    => __( 'The internal indents of the section.', 'core' ),
				'choices' => array(
					'module-sm' => __( 'Small', 'core' ),
					'module'    => __( 'Default', 'core' ),
					'custom'    => __( 'Custom', 'core' ),
				),
				'inline' => true,
			),
		),
		'choices' => array(

			'custom' => array(

				'top' => array(
					'type'       => 'slider',
					'value'      => 0,
					'properties' => array(
						'min'  => 0,
						'max'  => 140,
						'step' => 5,
					),
					'label' => __( 'Top', 'core' ),
					'desc'  => __( 'The top indent of the section in pixels.', 'core' ),
				),

				'bottom' => array(
					'type'       => 'slider',
					'value'      => 0,
					'properties' => array(
						'min'  => 0,
						'max'  => 140,
						'step' => 5,
					),
					'label' => __( 'Bottom', 'core' ),
					'desc'  => __( 'The bottom indent of the section in pixels.', 'core' ),
				),
			),
		),
		'show_borders' => false,
	),

	'dividers' => array(
		'type'  => 'checkboxes',
		'value' => array(
			'module-divider-top'    => false,
			'module-divider-bottom' => false,
		),
		'label' => __( 'Dividers', 'core' ),
		'desc'  => __( 'Display dividers at the top or bottom of the section.', 'core' ),
		'choices' => array(
			'module-divider-top'    => __( 'Top', 'core' ),
			'module-divider-bottom' => __( 'Bottom', 'core' ),
		),
		'inline' => true,
	),
);



// Shortcode options.
$options = array(

	'section_id' => array(
		'type'  => 'short-text',
		'value' => '',
		'label' => __( 'ID', 'core' ),
		'desc'  => __( 'Unique section identificator.', 'core' ),
	),

	'type' => array(
		'type'   => 'multi-picker',
		'label'  => false,
		'desc'   => false,
		'value'  => array(),
		'picker' => array(
			'type_choice' => array(
				'type'    => 'select',
				'value'   => 'standard',
				'label'   => __( 'Type', 'core' ),
				'desc'    => __( 'Select the type of the section.', 'core' ),
				'help'    => __( 'When using some types of sections (such as Map, Blog, Portfolio), any layout elements placed inside will be ignored.', 'core' ),
				'choices' => array(
					'standard'  => __( 'Standard', 'core' ),
					'blog'      => __( 'Blog', 'core' ),
					'portfolio' => __( 'Portfolio', 'core' ),
					'map'       => __( 'Map', 'core' ),
				),
			),
		),
		'choices' => array(

			'standard' => $appearance_options + array(

				'background' => array(
					'type'   => 'multi-picker',
					'label'  => false,
					'desc'   => false,
					'value'  => array(),
					'picker' => array(
						'background_type' => array(
							'type'    => 'radio',
							'value'   => 'default_background',
							'label'   => __( 'Background', 'core' ),
							'desc'    => __( 'The background appearance of the section.', 'core' ),
							'choices' => array(
								'default_background' => __( 'Default', 'core' ),
								'gray_background'    => __( 'Gray', 'core' ),
								'media_background'   => __( 'Media', 'core' ),
							),
							'inline' => true,
						),
					),
					'choices' => array(

						'media_background' => array(

							'image' => array(
								'type'  => 'background-image',
								'label' => __( 'Image', 'core' ),
								'desc'  => __( 'The image used as the background of the section.', 'core' ),
							),

							'video' => array(
								'type'  => 'text',
								'label' => __( 'Video', 'core' ),
								'desc'  => sprintf( '%s<br>%s',
									__( 'The link to the video used as the background of the section.', 'core' ),
									__( 'If you also specify an image background, it will be used instead of video on mobile devices, or if the video is not available.', 'core' )
								),
								'help' => __( 'Available using only YouTube and Vimeo links.', 'core' ),
							),

							'style' => array(
								'type'   => 'multi-picker',
								'label'  => false,
								'desc'   => false,
								'value'  => array(),
								'picker' => array(
									'style_type' => array(
										'type'    => 'radio',
										'value'   => 'standard',
										'label'   => __( 'Style', 'core' ),
										'desc'    => __( 'The style of the overlay that is displayed over the background.', 'core' ),
										'choices' => array(
											'standard' => __( 'Standard', 'core' ),
											'gradient' => __( 'Gradient', 'core' ),
										),
										'inline' => true,
									),
								),
								'choices' => array(

									'standard' => array(

										'shade' => array(
											'type'  => 'switch',
											'value' => 'bg-dark',
											'label' => __( 'Shade', 'core' ),
											'desc'  => __( 'The shade of the overlay that is displayed over the background.', 'core' ),
											'left-choice' => array(
												'value' => 'bg-light',
												'label' => __( 'Light', 'core' ),
											),
											'right-choice' => array(
												'value' => 'bg-dark',
												'label' => __( 'Dark', 'core' ),
											),
										),

										'opacity' => array(
											'type'    => 'radio',
											'value'   => '30',
											'label'   => __( 'Opacity', 'core' ),
											'desc'    => __( 'The opacity level of the overlay that is displayed over the background.', 'core' ),
											'choices' => array(
												'30' => __( 'Low', 'core' ),
												'60' => __( 'Average', 'core' ),
												'90' => __( 'High', 'core' ),
											),
											'inline' => true,
										),
									),
								),
							),
						),
					),
				),
			),

			'blog' => array(

				'settings' => array(
					'type'    => 'tab',
					'title'   => __( 'Settings', 'core' ),
					'options' => array(

						'selection' => array(
							'type'   => 'multi-picker',
							'label'  => false,
							'desc'   => false,
							'value'  => array(),
							'picker' => array(
								'selection_type' => array(
									'type'    => 'radio',
									'value'   => 'default',
									'label'   => __( 'Selection', 'core' ),
									'desc'    => __( 'Type of selection of the blog posts.', 'core' ),
									'choices' => array(
										'default' => __( 'Default', 'core' ),
										'custom'  => __( 'Custom', 'core' ),
									),
									'inline' => true,
								),
							),
							'choices' => array(

								'default' => array(

									'condition' => array(
										'type'    => 'radio',
										'value'   => 'recent',
										'label'   => __( 'Condition', 'core' ),
										'desc'    => __( 'Condition of a selection of the blog posts.', 'core' ),
										'choices' => array(
											'recent' => __( 'Recent', 'core' ),
											'random' => __( 'Random', 'core' ),
										),
										'inline' => true,
									),

									'count' => array(
										'type'  => 'core-number',
										'value' => '3',
										'min'   => '1',
										'max'   => '9',
										'label' => __( 'Count', 'core' ),
										'desc'  => __( 'The number of posts that will be shown.', 'core' ),
									),
								),

								'custom' => array(

									'posts_ids' => array(
										'type'       => 'multi-select',
										'value'      => '',
										'label'      => __( 'Projects', 'core' ),
										'desc'       => __( 'Select any blog posts.', 'core' ),
										'population' => 'posts',
										'source'     => 'post',
										'limit'      => 9,
									),
								),
							),
						),

						'layout' => array(
							'type'    => 'radio',
							'value'   => 'grid-no-sidebar',
							'label'   => __( 'Layout', 'core' ),
							'desc'    => __( 'Layout type.', 'core' ),
							'choices' => array(
								'grid-no-sidebar'    => __( 'Grid', 'core' ),
								'masonry-no-sidebar' => __( 'Masonry', 'core' ),
							),
							'inline' => true,
						),
					),
				),

				'appearance' => array(
					'type'    => 'tab',
					'title'   => __( 'Appearance', 'core' ),
					'options' => $appearance_options,
				),
			),

			'portfolio' => array(

				'settings' => array(
					'type'    => 'tab',
					'title'   => __( 'Settings', 'core' ),
					'options' => array(

						'selection' => array(
							'type'   => 'multi-picker',
							'label'  => false,
							'desc'   => false,
							'value'  => array(),
							'picker' => array(
								'selection_type' => array(
									'type'    => 'radio',
									'value'   => 'default',
									'label'   => __( 'Selection', 'core' ),
									'desc'    => __( 'Type of selection of the portfolio projects.', 'core' ),
									'choices' => array(
										'default' => __( 'Default', 'core' ),
										'custom'  => __( 'Custom', 'core' ),
									),
									'inline' => true,
								),
							),
							'choices' => array(

								'default' => array(

									'condition' => array(
										'type'    => 'radio',
										'value'   => 'recent',
										'label'   => __( 'Condition', 'core' ),
										'desc'    => __( 'Condition of a selection of the portfolio projects.', 'core' ),
										'choices' => array(
											'recent' => __( 'Recent', 'core' ),
											'random' => __( 'Random', 'core' ),
										),
										'inline' => true,
									),

									'count' => array(
										'type'  => 'core-number',
										'value' => '6',
										'min'   => '1',
										'max'   => '18',
										'label' => __( 'Count', 'core' ),
										'desc'  => __( 'The number of projects that will be shown.', 'core' ),
									),
								),

								'custom' => array(

									'projects_ids' => array(
										'type'       => 'multi-select',
										'value'      => '',
										'label'      => __( 'Projects', 'core' ),
										'desc'       => __( 'Select any portfolio projects.', 'core' ),
										'population' => 'posts',
										'source'     => 'fw-portfolio',
										'limit'      => 18,
									),
								),
							),
						),

						'layout' => array(
							'type'    => 'radio',
							'value'   => 'standard',
							'label'   => __( 'Layout', 'core' ),
							'desc'    => __( 'Layout type.', 'core' ),
							'choices' => array(
								'standard' => __( 'Standard', 'core' ),
								'grid'     => __( 'Grid', 'core' ),
								'masonry'  => __( 'Masonry', 'core' ),
							),
							'inline' => true,
						),

						'columns' => array(
							'type'    => 'short-select',
							'value'   => '3',
							'label'   => __( 'Columns', 'core' ),
							'desc'    => __( 'Number of columns of the current portfolio layout.', 'core' ),
							'choices' => array( '3' => '3', '4' => '4' ),
						),

						'filters' => array(
							'type'        => 'switch',
							'value'       => 'hide',
							'label'       => __( 'Filters', 'core' ),
							'desc'        => __( 'Displaying filters.', 'core' ),
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
				),

				'appearance' => array(
					'type'    => 'tab',
					'title'   => __( 'Appearance', 'core' ),
					'options' => $appearance_options,
				),
			),

			'map' => _core_get_options_config( 'map' ),
		),
		'show_borders' => true,
	),
);

?>
