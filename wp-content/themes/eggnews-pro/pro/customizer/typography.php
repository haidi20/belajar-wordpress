<?php
add_action( 'customize_register', 'eggnews_typography_settings_register' );

function eggnews_typography_settings_register( $wp_customize ) {


// Start of the Typography Option
	$wp_customize->add_panel( 'eggnews_typography_options', array(
		'priority'    => 10,
		'title'       => __( 'Typography Setting', 'eggnews-pro' ),
		'description' => __( 'Change the Typography Settings from here.', 'eggnews-pro' ),
		'capability'  => 'edit_theme_options'
	) );

// google font options
	$wp_customize->add_section( 'eggnews_google_fonts_settings', array(
		'priority' => 1,
		'title'    => __( 'Google Fonts', 'eggnews-pro' ),
		'panel'    => 'eggnews_typography_options'
	) );

	$eggnews_fonts = array(
		'eggnews_site_title_font'       => array(
			'id'      => 'eggnews_site_title_font',
			'default' => 'Merriweather',
			'title'   => __( 'Site title font. Default is "Merriweather"', 'eggnews-pro' )
		),
		'eggnews_site_description_font' => array(
			'id'      => 'eggnews_site_description_font',
			'default' => 'Merriweather',
			'title'   => __( 'Site description font. Default is "Merriweather"', 'eggnews-pro' )
		),
		'eggnews_primary_menu_font'     => array(
			'id'      => 'eggnews_primary_menu_font',
			'default' => 'Merriweather',
			'title'   => __( 'Primary menu font. Default is "Merriweather"', 'eggnews-pro' )
		),
		'eggnews_all_titles_font'       => array(
			'id'      => 'eggnews_all_titles_font',
			'default' => 'Merriweather',
			'title'   => __( 'All Titles font. Default is "Merriweather"', 'eggnews-pro' )
		),
		'eggnews_content_font'          => array(
			'id'      => 'eggnews_content_font',
			'default' => 'Merriweather',
			'title'   => __( 'Content font and for others. Default is "Merriweather"', 'eggnews-pro' )
		)
	);
	foreach ( $eggnews_fonts as $eggnews_font ) {
		$wp_customize->add_setting(
			$eggnews_font['id'], array(
				'default'           => $eggnews_font['default'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'eggnews_fonts_sanitization'
			)
		);

		$eggnews_google_font = eggnews_typography_get_google_fonts();

		$wp_customize->add_control(
			$eggnews_font['id'], array(
				'label'    => $eggnews_font['title'],
				'type'     => 'select',
				'settings' => $eggnews_font['id'],
				'section'  => 'eggnews_google_fonts_settings',
				'choices'  => $eggnews_google_font
			)
		);
	}

// header font size option
	$wp_customize->add_section( 'eggnews_header_font_size_setting', array(
		'priority' => 2,
		'title'    => __( 'Header font size Options', 'eggnews-pro' ),
		'panel'    => 'eggnews_typography_options'
	) );

	$wp_customize->add_setting( 'eggnews_title_font_size', array(
		'priority'          => 1,
		'default'           => '32',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'eggnews_radio_select_sanitize'
	) );

	$wp_customize->add_control( 'eggnews_title_font_size', array(
		'type'     => 'select',
		'label'    => __( 'Site title font size. Default is 32px', 'eggnews-pro' ),
		'section'  => 'eggnews_header_font_size_setting',
		'settings' => 'eggnews_title_font_size',
		'choices'  => eggnews_font_size_range_generator( 25, 80 )
	) );

	$wp_customize->add_setting( 'eggnews_description_font_size', array(
		'priority'          => 2,
		'default'           => '14',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'eggnews_radio_select_sanitize'
	) );

	$wp_customize->add_control( 'eggnews_description_font_size', array(
		'type'     => 'select',
		'label'    => __( 'Site description font size. Default is 14px', 'eggnews-pro' ),
		'section'  => 'eggnews_header_font_size_setting',
		'settings' => 'eggnews_description_font_size',
		'choices'  => eggnews_font_size_range_generator( 10, 30 )
	) );

	$wp_customize->add_setting( 'eggnews_primary_menu_font_size', array(
		'priority'          => 3,
		'default'           => '14',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'eggnews_radio_select_sanitize'
	) );

	$wp_customize->add_control( 'eggnews_primary_menu_font_size', array(
		'type'     => 'select',
		'label'    => __( 'Primary navigation ( Default is 14px) ', 'eggnews-pro' ),
		'section'  => 'eggnews_header_font_size_setting',
		'settings' => 'eggnews_primary_menu_font_size',
		'choices'  => eggnews_font_size_range_generator( 10, 30 )
	) );

	$wp_customize->add_setting( 'eggnews_primary_sub_menu_font_size', array(
		'priority'          => 4,
		'default'           => '14',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'eggnews_radio_select_sanitize'
	) );

	$wp_customize->add_control( 'eggnews_primary_sub_menu_font_size', array(
		'type'     => 'select',
		'label'    => __( 'Primary Sub navigation ( Default is 14px)', 'eggnews-pro' ),
		'section'  => 'eggnews_header_font_size_setting',
		'settings' => 'eggnews_primary_sub_menu_font_size',
		'choices'  => eggnews_font_size_range_generator( 10, 30 )
	) );

// titles related font size option
	$wp_customize->add_section( 'eggnews_titles_related_font_size_setting', array(
		'priority' => 5,
		'title'    => __( 'Font sizes for titles', 'eggnews-pro' ),
		'panel'    => 'eggnews_typography_options'
	) );

	$wp_customize->add_setting( 'eggnews_heading_h1_font_size', array(
		'priority'          => 1,
		'capability'        => 'edit_theme_options',
		'default'           => '36',
		'sanitize_callback' => 'eggnews_radio_select_sanitize'
	) );

	$wp_customize->add_control( 'eggnews_heading_h1_font_size', array(
		'type'     => 'select',
		'label'    => __( 'Heading h1 tag. Default is 36px', 'eggnews-pro' ),
		'section'  => 'eggnews_titles_related_font_size_setting',
		'settings' => 'eggnews_heading_h1_font_size',
		'choices'  => eggnews_font_size_range_generator( 32, 55 )
	) );

	$wp_customize->add_setting( 'eggnews_heading_h2_font_size', array(
		'priority'          => 2,
		'capability'        => 'edit_theme_options',
		'default'           => '30',
		'sanitize_callback' => 'eggnews_radio_select_sanitize'
	) );

	$wp_customize->add_control( 'eggnews_heading_h2_font_size', array(
		'type'     => 'select',
		'label'    => __( 'Heading h2 tag. Default is 30px', 'eggnews-pro' ),
		'section'  => 'eggnews_titles_related_font_size_setting',
		'settings' => 'eggnews_heading_h2_font_size',
		'choices'  => eggnews_font_size_range_generator( 25, 50 )
	) );

	$wp_customize->add_setting( 'eggnews_heading_h3_font_size', array(
		'priority'          => 3,
		'capability'        => 'edit_theme_options',
		'default'           => '26',
		'sanitize_callback' => 'eggnews_radio_select_sanitize'
	) );

	$wp_customize->add_control( 'eggnews_heading_h3_font_size', array(
		'type'     => 'select',
		'label'    => __( 'Heading h3 tag. Default is 26px', 'eggnews-pro' ),
		'section'  => 'eggnews_titles_related_font_size_setting',
		'settings' => 'eggnews_heading_h3_font_size',
		'choices'  => eggnews_font_size_range_generator( 20, 45 )
	) );

	$wp_customize->add_setting( 'eggnews_heading_h4_font_size', array(
		'priority'          => 4,
		'capability'        => 'edit_theme_options',
		'default'           => '20',
		'sanitize_callback' => 'eggnews_radio_select_sanitize'
	) );

	$wp_customize->add_control( 'eggnews_heading_h4_font_size', array(
		'type'     => 'select',
		'label'    => __( 'Heading h4 tag. Default is 20px', 'eggnews-pro' ),
		'section'  => 'eggnews_titles_related_font_size_setting',
		'settings' => 'eggnews_heading_h4_font_size',
		'choices'  => eggnews_font_size_range_generator( 18, 35 )
	) );

	$wp_customize->add_setting( 'eggnews_heading_h5_font_size', array(
		'priority'          => 5,
		'capability'        => 'edit_theme_options',
		'default'           => '18',
		'sanitize_callback' => 'eggnews_radio_select_sanitize'
	) );

	$wp_customize->add_control( 'eggnews_heading_h5_font_size', array(
		'type'     => 'select',
		'label'    => __( 'Heading h5 tag. Default is 18px', 'eggnews-pro' ),
		'section'  => 'eggnews_titles_related_font_size_setting',
		'settings' => 'eggnews_heading_h5_font_size',
		'choices'  => eggnews_font_size_range_generator( 12, 28 )
	) );

	$wp_customize->add_setting( 'eggnews_heading_h6_font_size', array(
		'priority'          => 6,
		'capability'        => 'edit_theme_options',
		'default'           => '16',
		'sanitize_callback' => 'eggnews_radio_select_sanitize'
	) );

	$wp_customize->add_control( 'eggnews_heading_h6_font_size', array(
		'type'     => 'select',
		'label'    => __( 'Heading h6 tag. Default is 16px', 'eggnews-pro' ),
		'section'  => 'eggnews_titles_related_font_size_setting',
		'settings' => 'eggnews_heading_h6_font_size',
		'choices'  => eggnews_font_size_range_generator( 12, 23 )
	) );

	$wp_customize->add_setting( 'eggnews_post_title_font_size', array(
		'priority'          => 8,
		'capability'        => 'edit_theme_options',
		'default'           => '28',
		'sanitize_callback' => 'eggnews_radio_select_sanitize'
	) );

	$wp_customize->add_control( 'eggnews_post_title_font_size', array(
		'type'     => 'select',
		'label'    => __( 'Post Title. Default is 28px', 'eggnews-pro' ),
		'section'  => 'eggnews_titles_related_font_size_setting',
		'settings' => 'eggnews_post_title_font_size',
		'choices'  => eggnews_font_size_range_generator( 23, 49 )
	) );

	$wp_customize->add_setting( 'eggnews_page_title_font_size', array(
		'priority'          => 9,
		'capability'        => 'edit_theme_options',
		'default'           => '28',
		'sanitize_callback' => 'eggnews_radio_select_sanitize'
	) );

	$wp_customize->add_control( 'eggnews_page_title_font_size', array(
		'type'     => 'select',
		'label'    => __( 'Page Title. Default is 28px', 'eggnews-pro' ),
		'section'  => 'eggnews_titles_related_font_size_setting',
		'settings' => 'eggnews_page_title_font_size',
		'choices'  => eggnews_font_size_range_generator( 23, 49 )
	) );

	$wp_customize->add_setting( 'eggnews_widget_title_font_size', array(
		'priority'          => 10,
		'capability'        => 'edit_theme_options',
		'default'           => '18',
		'sanitize_callback' => 'eggnews_radio_select_sanitize'
	) );

	$wp_customize->add_control( 'eggnews_widget_title_font_size', array(
		'type'     => 'select',
		'label'    => __( 'Widget Title. Default is 18px', 'eggnews-pro' ),
		'section'  => 'eggnews_titles_related_font_size_setting',
		'settings' => 'eggnews_widget_title_font_size',
		'choices'  => eggnews_font_size_range_generator( 15, 30 )
	) );

	$wp_customize->add_setting( 'eggnews_comment_title_font_size', array(
		'priority'          => 11,
		'capability'        => 'edit_theme_options',
		'default'           => '22',
		'sanitize_callback' => 'eggnews_radio_select_sanitize'
	) );

	$wp_customize->add_control( 'eggnews_comment_title_font_size', array(
		'type'     => 'select',
		'label'    => __( 'Comment Title. Default is 22px', 'eggnews-pro' ),
		'section'  => 'eggnews_titles_related_font_size_setting',
		'settings' => 'eggnews_comment_title_font_size',
		'choices'  => eggnews_font_size_range_generator( 12, 40 )
	) );
	// footer font size option
	$wp_customize->add_section( 'eggnews_footer_font_size_setting', array(
		'priority' => 7,
		'title'    => __( 'Footer font size options', 'eggnews-pro' ),
		'panel'    => 'eggnews_typography_options'
	) );

	$wp_customize->add_setting( 'eggnews_footer_widget_title_font_size', array(
		'priority'          => 1,
		'capability'        => 'edit_theme_options',
		'default'           => '18',
		'sanitize_callback' => 'eggnews_radio_select_sanitize'
	) );

	$wp_customize->add_control( 'eggnews_footer_widget_title_font_size', array(
		'type'     => 'select',
		'label'    => __( 'Footer widget Titles. Default is 18px', 'eggnews-pro' ),
		'section'  => 'eggnews_footer_font_size_setting',
		'settings' => 'eggnews_footer_widget_title_font_size',
		'choices'  => eggnews_font_size_range_generator( 12, 46 )
	) );

	$wp_customize->add_setting( 'eggnews_footer_widget_content_font_size', array(
		'priority'          => 2,
		'capability'        => 'edit_theme_options',
		'default'           => '14',
		'sanitize_callback' => 'eggnews_radio_select_sanitize'
	) );

	$wp_customize->add_control( 'eggnews_footer_widget_content_font_size', array(
		'type'     => 'select',
		'label'    => __( 'Footer widget content font size. Default is 14px', 'eggnews-pro' ),
		'section'  => 'eggnews_footer_font_size_setting',
		'settings' => 'eggnews_footer_widget_content_font_size',
		'choices'  => eggnews_font_size_range_generator( 10, 30 )
	) );

	$wp_customize->add_setting( 'eggnews_footer_copyright_text_font_size', array(
		'priority'          => 3,
		'capability'        => 'edit_theme_options',
		'default'           => '13',
		'sanitize_callback' => 'eggnews_radio_select_sanitize'
	) );

	$wp_customize->add_control( 'eggnews_footer_copyright_text_font_size', array(
		'type'     => 'select',
		'label'    => __( 'Footer copyright text font size. Default is 13px', 'eggnews-pro' ),
		'section'  => 'eggnews_footer_font_size_setting',
		'settings' => 'eggnews_footer_copyright_text_font_size',
		'choices'  => eggnews_font_size_range_generator( 10, 22 )
	) );
}


