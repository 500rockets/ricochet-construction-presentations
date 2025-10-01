<?php

function core_validate_hex( $hex ) {
	if ( preg_match( '/^#([0-9a-fA-F]{6})$/', $hex ) || preg_match( '/^#([0-9a-fA-F]{3})$/', $hex ) ) {
		$hex = substr( $hex, 1 );
	}
	if ( preg_match( '/^([0-9a-fA-F]{6})$/', $hex ) ) {
		return $hex;
	}
	if ( preg_match( '/^([0-9a-f]{3})$/', $hex ) ) {
		return substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) . substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) . substr( $hex, 2, 1 ) . substr( $hex, 2, 1 );
	}
	return '000000';
}

function core_hex2rgb( $hex ) {
	$hex = core_validate_hex( $hex );
	$hex = str_split( $hex, 2 );

	$red   = ( hexdec( $hex[0] ) );
	$green = ( hexdec( $hex[1] ) );
	$blue  = ( hexdec( $hex[2] ) );

	return array( $red, $green, $blue );
}

function core_hex2hsl( $hex ) {
	$hex = core_validate_hex( $hex );
	$hex = str_split( $hex, 2 );

	$red   = ( hexdec( $hex[0] ) ) / 255;
	$green = ( hexdec( $hex[1] ) ) / 255;
	$blue  = ( hexdec( $hex[2] ) ) / 255;

	return core_rgb2hsl( array( $red, $green, $blue ) );
}

function core_rgb2hsl( $rgb ) {
	list( $red, $green, $blue ) = $rgb;
	$max    = max( $red, $green, $blue );
	$min    = min( $red, $green, $blue );
	$chroma = $max - $min;

	$lightness = ( $max + $min ) / 2;

	if ( $chroma == 0 ) {
		$hue        = 0;
		$saturation = 0;
	} else {
		switch ( $max ) {
			case $red:
				$hue = fmod( ( ( $green - $blue ) / $chroma ), 6 );
				if ( $hue < 0 ) {
					$hue = ( 6 - fmod( abs( $hue ), 6 ) );
				}
				break;
			case $green:
				$hue = ( $blue - $red ) / $chroma + 2;
				break;
			case $blue:
				$hue = ( $red - $green ) / $chroma + 4;
				break;
			default:
				break;
		}
		$hue = $hue / 6;
		$saturation = $chroma / ( 1 - abs( 2 * $lightness - 1 ) );
	}

	return array( $hue, $saturation, $lightness );
}

function core_hsl2rgb( $hsl ) {
	list( $hue, $saturation, $lightness ) = $hsl;

	$lightness = ( $lightness < 0 ) ? 0 : $lightness;

	if ( $saturation == 0 ) {
		$rgb = array( $lightness, $lightness, $lightness );
	} else {
		$chroma = ( 1 - abs( 2 * $lightness - 1 ) ) * $saturation;
		$hue    = $hue * 6;
		$x      = $chroma * ( 1 - abs( ( fmod( $hue, 2 ) ) - 1 ) );
		$m      = $lightness - round( $chroma / 2, 10 );

		if ( $hue >= 0 && $hue < 1 ) {
			$rgb = array( ( $chroma + $m ), ( $x + $m ), $m );
		} elseif ( $hue >= 1 && $hue < 2 ) {
			$rgb = array( ( $x + $m ), ( $chroma + $m ), $m );
		} elseif ( $hue >= 2 && $hue < 3 ) {
			$rgb = array( $m, ( $chroma + $m ), ( $x + $m ) );
		} elseif ( $hue >= 3 && $hue < 4 ) {
			$rgb = array( $m, ( $x + $m ), ( $chroma + $m ) );
		} elseif ( $hue >= 4 && $hue < 5 ) {
			$rgb = array( ( $x + $m ), $m, ( $chroma + $m ) );
		} elseif ( $hue >= 5 && $hue < 6 ) {
			$rgb = array( ( $chroma + $m ), $m, ( $x + $m ) );
		}
	}
	return $rgb;
}

function core_rgb2hex( $rgb ) {
	list( $red, $green, $blue ) = $rgb;
	$red   = round( 255 * $red );
	$green = round( 255 * $green );
	$blue  = round( 255 * $blue );
	return strtolower( '#' . sprintf( '%02X', $red ) . sprintf( '%02X', $green ) . sprintf( '%02X', $blue ) );
}

function core_hsl2hex( $hsl ) {
	$rgb = core_hsl2rgb( $hsl );
	return core_rgb2hex( $rgb );
}

function core_reduce_color_lightness( $hex, $reduce = null ) {
	if ( ! isset( $reduce ) ) {
		$reduce = 0;
	} elseif ( $reduce >= 1 ) {
		$reduce = $reduce / 100;
	}
	$hsl    = core_hex2hsl( $hex );
	$hsl[2] = $hsl[2] - $reduce;
	return core_hsl2hex( $hsl );
}

function core_increace_color_lightness( $hex, $increace = null ) {
	if ( ! isset( $increace ) ) {
		$increace = 0;
	} elseif ( $increace >= 1 ) {
		$increace = $increace / 100;
	}
	$hsl    = core_hex2hsl( $hex );
	$hsl[2] = $hsl[2] + $increace;
	return core_hsl2hex( $hsl );
}

?>
