<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

// Define default contents.
$icon_box_layout = '';
$icon_box_info   = '';
$icon_box_icon   = '';

// Specifying the initial settings.
$attributes = array( 'class' => array( 'icon-box' ) );

// Start processed of the title option.
$icon_box_title = esc_html( $atts['title'] );

// Check if title is defined.
if ( $icon_box_title != '' ) {

	// Define the HTML layout of the title.
	$icon_box_title = '<div class="icon-box-title"><h6>' . $icon_box_title . '</h6></div>';
}

// Start processed of the content option.
$icon_box_content = nl2br( esc_html( $atts['content'] ) );

// Check if content is defined.
if ( $icon_box_content != '' ) {

	// Define the HTML layout of the content.
	$icon_box_content = '<div class="icon-box-content"><p>' . $icon_box_content . '</p></div>';
}

// Start processed info option.
$info_content = _core_get_special_typed_content( $atts['info'] );

// Check if content is defined.
if ( $info_content != '' ) {

	// Define the HTML layout of the icon box info.
	$icon_box_info = '<div class="icon-box-link">' . $info_content . '</div>';
}

// Start processed icon option.
$box_icon  = $atts['icon'];
$icon_type = fw_akg( 'type', $box_icon );

// Check if selected icon font.
if ( $icon_type == 'icon-font' ) {

	$icon_class = fw_akg( 'icon-class', $box_icon );

	// Check if the option has some value.
	if ( ! empty( $icon_class ) ) {

		// Define the HTML layout of the block with icon.
		$icon_box_icon =
		'<div class="icon-box-icon">' .
			'<span class="' . $icon_class . '"></span>' .
		'</div>';
	}

// Check if selected custom upload.
} elseif ( $icon_type == 'custom-upload' ) {

	$image_url = fw_akg( 'url', $box_icon );

	// Check if the option has some value.
	if ( ! empty( $image_url ) ) {

		// Define the HTML layout of the block with icon.
		$icon_box_icon =
		'<div class="icon-box-icon">' .
			'<img class="p-b-20" src="' . $image_url . '" alt="">' .
		'</div>';
	}
}

// Start processed of the layout option.
$layout_type = esc_attr( $atts['layout'] );

// Check if icon is defined.
if ( ! empty( $icon_box_icon ) ) {

	// Supplement the set of styles.
	$attributes['class'][] = $layout_type;

} elseif ( $layout_type == 'icon-box-left'  ) {

	// Supplement the set of styles.
	$attributes['class'][] = 'text-left';
}

// Convert the attributes to string.
$attributes = core_attr_to_html( $attributes );

// Define the HTML layout of the icon box.
$icon_box_layout =
'<div ' . $attributes . '>' .
	$icon_box_icon .
	$icon_box_title .
	$icon_box_content .
	$icon_box_info .
'</div>';

// Output the HTML layout of the icon box.
echo $icon_box_layout;

?>
