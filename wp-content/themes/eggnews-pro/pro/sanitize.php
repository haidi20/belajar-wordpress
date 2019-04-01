<?php

// google fonts sanitization
function eggnews_fonts_sanitization( $input ) {
	$eggnews_google_font = eggnews_typography_get_google_fonts();
	$valid_keys = $eggnews_google_font;
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

if ( ! function_exists( 'eggnews_sanitize_number' ) ) :
	function eggnews_sanitize_number ( $eggnews_input, $eggnews_setting ) {
		$eggnews_sanitize_text = sanitize_text_field( $eggnews_input );

		// If the input is an number, return it; otherwise, return the default
		return ( is_numeric( $eggnews_sanitize_text ) ? $eggnews_sanitize_text : $eggnews_setting->default );
	}
endif;
// radio/select buttons sanitization
function eggnews_radio_select_sanitize( $input, $setting ) {
	// Ensuring that the input is a slug.
	$input = sanitize_key( $input );
	// Get the list of choices from the control eggnews with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	// If the input is a valid key, return it, else, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
// site layout
function eggnews_sanitize_header_style( $input ) {
	$valid_keys = array(
		'style-1' => __( 'Style 1', 'eggnews-pro' ),
		'style-2' => __( 'Style 2', 'eggnews-pro' ),
		'style-3' => __( 'Style 3', 'eggnews-pro' ),
		'style-4' => __( 'Style 4', 'eggnews-pro' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}
// site layout
function eggnews_hide_header_date( $input ) {
	$valid_keys = array(
		'1' => __( 'Yes', 'eggnews-pro' ),
		'0' => __( 'No', 'eggnews-pro' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

  
// footer section sanitization
function eggnews_footer_editor_sanitize( $input ) {
	if ( isset( $input ) ) {
		$input = stripslashes( wp_filter_post_kses( addslashes( $input ) ) );
	}
	return $input;
}

?>
