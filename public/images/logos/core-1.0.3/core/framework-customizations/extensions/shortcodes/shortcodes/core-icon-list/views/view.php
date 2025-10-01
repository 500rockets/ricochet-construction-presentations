<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$icon_list_layout = '';
$items_layout     = '';
$items_option     = $atts['icon_list'];

foreach ( $items_option as $item_data ) {

	// Specifying the initial settings.
	$list_item_icon    = '';
	$list_item_content = '';

	// Start processed icon option.
	$item_icon = fw_akg( 'icon', $item_data );
	$icon_type = fw_akg( 'type', $item_icon );

	// Check if selected icon font.
	if ( $icon_type == 'icon-font' ) {

		$icon_class = fw_akg( 'icon-class', $item_icon );

		// Check if the option has some value.
		if ( ! empty( $icon_class ) ) {

			// Define the HTML layout of the item icon.
			$list_item_icon = '<span class="icon ' . $icon_class . '"></span>';
		}

	// Check if selected custom upload.
	} elseif ( $icon_type == 'custom-upload' ) {

		$image_url = fw_akg( 'url', $item_icon );

		// Check if the option has some value.
		if ( ! empty( $image_url ) ) {

			// Define the HTML layout of the item icon.
			$list_item_icon = '<img class="icon icon-list-image" src="' . $image_url . '" alt="">';
		}
	}

	// Start processed content option.
	$item_type = fw_akg( 'type', $item_data );

	// Define content of the list item.
	$list_item_content = _core_get_special_typed_content( $item_type );

	// Check if content is defined.
	if ( $list_item_content != '' ) {

		// Define the HTML layout of the item content.
		$list_item_content = '<span>' . $list_item_content . '</span>';
	}

	// Check if the icon or content has some values.
	if ( ! empty( $list_item_icon ) || ! empty( $list_item_content ) ) {

		// Supplement the HTML layout of the items.
		$items_layout .= '<li>' . $list_item_icon . $list_item_content . '</li>';
	}
}

// Define the need for output icon list.
if ( ! empty( $items_layout ) ) {

	// Define the HTML layout of the icon list.
	$icon_list_layout = '<ul class="icon-list">' . $items_layout . '</ul>';
}

// Output the HTML layout of the icon list.
echo $icon_list_layout;

?>
