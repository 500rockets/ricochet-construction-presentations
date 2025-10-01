<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

$form_layout      = '';
$form_kind_option = $atts['form_kind'];

// Check if plugin is activated, and selected one of it forms.
if ( defined( 'WPCF7_VERSION' ) && $form_kind_option != 'none' ) {

	// Define form identificator.
	$cf7_form_data = explode( '_', $form_kind_option );
	$cf7_form_id   = $cf7_form_data[1];

	// Define the HTML layout of the form.
	$form_layout = do_shortcode( sprintf( '[contact-form-7 id="%s"]', $cf7_form_id ) );
}

// Output the HTML layout of the form.
echo $form_layout;

?>
