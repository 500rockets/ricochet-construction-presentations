<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

// All contact forms.
if ( defined( 'WPCF7_VERSION' ) ) {
	$cf7_forms = get_posts( array( 'post_type' => 'wpcf7_contact_form', 'numberposts' => '-1' ) );
} else {
	$cf7_forms = array();
}



// Shortcode options.
$options = array(

	'form_kind' => array(
		'type'    => 'select',
		'value'   => 'none',
		'label'   => __( 'Kind', 'core' ),
		'desc'    => __( 'Select one of the forms created with the Contact Form 7 plugin.', 'core' ),
		'choices' => array(
			'none' => __( 'Not Selected', 'core' ),
		) + _core_array_key_prefix( wp_list_pluck( $cf7_forms, 'post_title', 'ID' ), 'form_' ),
	),
);

?>
