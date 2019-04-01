<?php
/**
 * Define function about sanitation for customizer option
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

//Text
function eggnews_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

//Check box
function eggnews_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return 0;
	}
}

// Number
function eggnews_sanitize_number( $input ) {
	$output = intval( $input );

	return $output;
}

// site layout
function eggnews_sanitize_site_layout( $input ) {
	$valid_keys = array(
		'fullwidth_layout' => __( 'Fullwidth Layout', 'eggnews-pro' ),
		'boxed_layout'     => __( 'Boxed Layout', 'eggnews-pro' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

// site indicator
function eggnews_sanitize_site_indicator( $input ) {
	$valid_keys = array(
		'top'    => __( 'Top', 'eggnews-pro' ),
		'right'  => __( 'Right', 'eggnews-pro' ),
		'bottom' => __( 'Bottom', 'eggnews-pro' ),
		'left'   => __( 'Left', 'eggnews-pro' ),
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return 'top';
	}
}

// site Image Hover Setting
function eggnews_website_image_hover_sanitize( $input ) {
	$valid_keys = eggnews_website_hover_option();
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}
// site layout
function eggnews_website_skin_sanitize( $input ) {
	$valid_keys = eggnews_website_skin();
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

// site title design
function eggnews_sanitize_title_design( $input ) {
	$valid_keys = eggnews_site_title_design();
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//site date format design 
function eggnews_sanitize_date_format( $input){
	$valid_keys = array(
		'l, F d, Y' => esc_html__( 'Format 1 (default)', 'eggnews-pro' ),
		'l, Y, F d' => esc_html__( 'Format 2', 'eggnews-pro' ),
		'Y, F d, l' => esc_html__( 'Format 3', 'eggnews-pro' ),
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

// site title design
function eggnews_sanitize_enable_breadcrumb( $input ) {
	$valid_keys = array(
		'yes' => __( 'Yes', 'eggnews-pro' ),
		'no'  => __( 'No', 'eggnews-pro' ),
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

// Switch option (enable/disable)
function eggnews_enable_switch_sanitize( $input ) {
	$valid_keys = array(
		'enable'  => __( 'Enable', 'eggnews-pro' ),
		'disable' => __( 'Disable', 'eggnews-pro' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//switch option (show/hide)
function eggnews_show_switch_sanitize( $input ) {
	$valid_keys = array(
		'show' => __( 'Show', 'eggnews-pro' ),
		'hide' => __( 'Hide', 'eggnews-pro' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//Archive page layout
function eggnews_sanitize_archive_layout( $input ) {
	$valid_keys = array(
		'classic' => __( 'Classic Layout', 'eggnews-pro' ),
		'columns' => __( 'Columns Layout', 'eggnews-pro' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//Post/Page sidebar layout
function eggnews_page_layout_sanitize( $input ) {
	$valid_keys = array(
		'right_sidebar'     => get_template_directory_uri() . '/inc/admin/assets/images/right-sidebar.png',
		'left_sidebar'      => get_template_directory_uri() . '/inc/admin/assets/images/left-sidebar.png',
		'no_sidebar'        => get_template_directory_uri() . '/inc/admin/assets/images/no-sidebar.png',
		'no_sidebar_center' => get_template_directory_uri() . '/inc/admin/assets/images/no-sidebar-center.png'
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//Footer widget columns
function eggnews_footer_widget_sanitize( $input ) {
	$valid_keys = array(
		'column1' => __( 'One Column', 'eggnews-pro' ),
		'column2' => __( 'Two Columns', 'eggnews-pro' ),
		'column3' => __( 'Three Columns', 'eggnews-pro' ),
		'column4' => __( 'Four Columns', 'eggnews-pro' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//Middle Footer widget columns
function eggnews_middle_footer_widget_sanitize( $input ) {
	$valid_keys = array(
		'column1' => __( 'One Column', 'eggnews-pro' ),
		'column2' => __( 'Two Columns', 'eggnews-pro' ),
		'column3' => __( 'Three Columns', 'eggnews-pro' ),
		'column4' => __( 'Four Columns', 'eggnews-pro' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//Related posts type
function eggnews_sanitize_related_type( $input ) {
	$valid_keys = array(
		'category' => __( 'by Category', 'eggnews-pro' ),
		'tag'      => __( 'by Tags', 'eggnews-pro' )
	);
	if ( array_key_exists( $input, $valid_keys ) ) {
		return $input;
	} else {
		return '';
	}
}

//Sanitize repeater value
function eggnews_sanitize_repeater($input) {
    $input_decoded = json_decode($input, true);
    if (!empty($input_decoded)) {
        foreach ($input_decoded as $boxes => $box) {
            foreach ($box as $key => $value) {
                $input_decoded[$boxes][$key] = wp_kses_post($value);
            }
        }
        return json_encode($input_decoded);
    }
    return $input;
}

//Sanitize for icon picker
function eggnews_sanitize_icon_picker($input) {
	$eggnews_fontawesome_social_icons = eggnews_font_awesome_icons();
    
    if ( in_array( $input, $eggnews_fontawesome_social_icons ) ) {
		return $input;
	} else {
		return '';
	}
}
require get_template_directory() . '/pro/sanitize.php'; //pro sanitize

