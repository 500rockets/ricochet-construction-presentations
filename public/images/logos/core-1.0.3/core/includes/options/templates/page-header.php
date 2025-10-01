<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$options = array(

	'page_header_type' => array(
		'type'   => 'multi-picker',
		'label'  => false,
		'desc'   => false,
		'value'  => array(),
		'picker' => array(
			'type_choice' => array(
				'type'    => 'radio',
				'value'   => 'simple',
				'label'   => __( 'Type', 'core' ),
				'desc'    => __( 'Type of the page header.', 'core' ),
				'choices' => array(
					'simple'   => __( 'Simple', 'core' ),
					'standard' => __( 'Standard', 'core' ),
					'slider'   => __( 'Slider', 'core' ),
				),
				'inline' => true,
			),
		),
		'choices' => array(

			'simple' => array(

				'title' => array(
					'type'          => 'multi',
					'label'         => false,
					'inner-options' => array(

						'single' => array(
							'type'  => 'multi',
							'label' => false,
							'attr'  => array(
								'class' => 'fw-option-type-multi-show-borders',
								'style' => 'margin-bottom: -1px',
							),
							'inner-options' => array(

								'text' => array(
									'type'  => 'text',
									'label' => __( 'Title', 'core' ),
									'desc'  => __( 'The title that displayed within the page header.', 'core' ),
								),

								'size' => array(
									'type'  => 'hidden',
									'value' => 'h5',
								),
							),
						),
					),
				),

				'subtitle' => array(
					'type'  => 'textarea',
					'label' => __( 'Subtitle', 'core' ),
					'desc'  => __( 'The subtitle that displayed within the page header.', 'core' ),
					'attr' => array( 'rows' => '3' ),
				),
			),

			'standard' => array(

				'content' => array(
					'type'    => 'tab',
					'title'   => __( 'Content', 'core' ),
					'options' => array(

						'title' => array(
							'type'            => 'addable-popup',
							'label'           => __( 'Title', 'core' ),
							'desc'            => __( 'The titles that displayed within the page header.', 'core' ),
							'template'        => '{{=text}}',
							'popup-title'     => __( 'Title Configuration', 'core' ),
							'size'            => 'small',
							'limit'           => 2,
							'add-button-text' => __( 'Add Title', 'core' ),
							'sortable'        => true,
							'popup-options'   => array(

								'text' => array(
									'type'  => 'textarea',
									'label' => __( 'Text', 'core' ),
									'desc'  => sprintf( '%s<br>%s<br>%s',
										__( 'The text that displayed within the title of the page header.', 'core' ),
										__( 'You can add a separator "[~]" to the text.', 'core' ),
										__( 'The parts of the text separated by it will be alternate through the animation.', 'core' )
									),
									'attr'  => array( 'rows' => '3' ),
								),

								'size' => array(
									'type'    => 'short-select',
									'label'   => __( 'Size', 'core' ),
									'desc'    => __( 'Select the size of the title.', 'core' ),
									'help'    => __( 'First the largest, sixth the smallest.', 'core' ),
									'value'   => 'h3',
									'choices' => array(
										'h1' => 'H1',
										'h2' => 'H2',
										'h3' => 'H3',
										'h4' => 'H4',
										'h5' => 'H5',
										'h6' => 'H6',
									),
								),
							),
						),

						'subtitle' => array(
							'type'  => 'textarea',
							'label' => __( 'Subtitle', 'core' ),
							'desc'  => sprintf( '%s<br>%s<br>%s',
								__( 'The subtitle that displayed within the page header.', 'core' ),
								__( 'You can add a separator "[~]" to the text.', 'core' ),
								__( 'The parts of the text separated by it will be alternate through the animation.', 'core' )
							),
							'attr' => array( 'rows' => '3' ),
						),

						'button' => array(
							'type'            => 'addable-popup',
							'label'           => __( 'Button', 'core' ),
							'desc'            => __( 'The buttons that displayed within the page header.', 'core' ),
							'template'        => '{{=label}}',
							'popup-title'     => __( 'Button Configuration', 'core' ),
							'size'            => 'large',
							'limit'           => 2,
							'add-button-text' => __( 'Add Button', 'core' ),
							'sortable'        => true,
							'popup-options'   => _core_get_options_config( 'button' ),
						),
					),
				),

				'appearance' => array(
					'type'    => 'tab',
					'title'   => __( 'Appearance', 'core' ),
					'options' => array(

						'size' => array(
							'type'    => 'radio',
							'value'   => 'default',
							'label'   => __( 'Size', 'core' ),
							'desc'    => __( 'The height of the page header.', 'core' ),
							'choices' => array(
								'default-height' => __( 'Default', 'core' ),
								'full-height'    => __( 'Full Height', 'core' ),
							),
							'inline' => true,
						),

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
									'desc'    => __( 'The background appearance of the page header.', 'core' ),
									'choices' => array(
										'default_background' => __( 'Default', 'core' ),
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
										'desc'  => __( 'The image used as the background of the page header.', 'core' ),
									),

									'video' => array(
										'type'  => 'text',
										'label' => __( 'Video', 'core' ),
										'desc'  => sprintf( '%s<br>%s',
											__( 'The link to the video used as the background of the page header.', 'core' ),
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
				),
			),

			'slider' => array(

				'slides' => array(
					'type'            => 'addable-popup',
					'label'           => __( 'Slides', 'core' ),
					'desc'            => __( 'Set of slides of the page header.', 'core' ),
					'template'        => '{{if(title.length==0){}}' . __( 'Untitled slide', 'core' ) . '{{}else{}}{{-title[0]["text"]}}{{}}}',
					'popup-title'     => __( 'Slide Configuration', 'core' ),
					'size'            => 'large',
					'limit'           => 5,
					'add-button-text' => __( 'Add', 'core' ),
					'sortable'        => true,
					'popup-options'   => array(

						'content' => array(
							'type'    => 'tab',
							'title'   => __( 'Content', 'core' ),
							'options' => array(

								'title' => array(
									'type'            => 'addable-popup',
									'label'           => __( 'Title', 'core' ),
									'desc'            => __( 'The titles that displayed within the slide.', 'core' ),
									'template'        => '{{=text}}',
									'popup-title'     => __( 'Title Configuration', 'core' ),
									'size'            => 'medium',
									'limit'           => 2,
									'add-button-text' => __( 'Add Title', 'core' ),
									'sortable'        => true,
									'popup-options'   => array(

										'text' => array(
											'type'  => 'textarea',
											'label' => __( 'Text', 'core' ),
											'desc'  => sprintf( '%s<br>%s<br>%s',
												__( 'The text that displayed within the title of the slide.', 'core' ),
												__( 'You can add a separator "[~]" to the text.', 'core' ),
												__( 'The parts of the text separated by it will be alternate through the animation.', 'core' )
											),
											'attr'  => array( 'rows' => '3' ),
										),

										'size' => array(
											'type'    => 'short-select',
											'label'   => __( 'Size', 'core' ),
											'desc'    => __( 'Select the size of the title.', 'core' ),
											'help'    => __( 'First the largest, sixth the smallest.', 'core' ),
											'value'   => 'h3',
											'choices' => array(
												'h1' => 'H1',
												'h2' => 'H2',
												'h3' => 'H3',
												'h4' => 'H4',
												'h5' => 'H5',
												'h6' => 'H6',
											),
										),
									),
								),

								'subtitle' => array(
									'type'  => 'textarea',
									'label' => __( 'Subtitle', 'core' ),
									'desc'  => sprintf( '%s<br>%s<br>%s',
										__( 'The subtitle that displayed within the slide.', 'core' ),
										__( 'You can add a separator "[~]" to the text.', 'core' ),
										__( 'The parts of the text separated by it will be alternate through the animation.', 'core' )
									),
									'attr' => array( 'rows' => '3' ),
								),

								'button' => array(
									'type'            => 'addable-popup',
									'label'           => __( 'Button', 'core' ),
									'desc'            => __( 'The buttons that displayed within the slide.', 'core' ),
									'template'        => '{{=label}}',
									'popup-title'     => __( 'Button Configuration', 'core' ),
									'size'            => 'large',
									'limit'           => 2,
									'add-button-text' => __( 'Add Button', 'core' ),
									'sortable'        => true,
									'popup-options'   => _core_get_options_config( 'button' ),
								),
							),
						),

						'appearance' => array(
							'type'    => 'tab',
							'title'   => __( 'Appearance', 'core' ),
							'options' => array(

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
											'desc'    => __( 'The background appearance of the slide.', 'core' ),
											'choices' => array(
												'default_background' => __( 'Default', 'core' ),
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
												'desc'  => __( 'The image used as the background of the slide.', 'core' ),
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
						),
					),
				),
			),
		),
		'show_borders' => true,
	),
);

?>
