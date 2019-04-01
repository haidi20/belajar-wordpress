<?php
/**
 * Customizer option for Header sections
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

add_action( 'customize_register', 'eggnews_header_settings_register' );

function eggnews_header_settings_register( $wp_customize ) {
	$wp_customize->remove_section( 'header_image' );
	/**
	 * Add header panels
	 */
	$wp_customize->add_panel(
		'eggnews_header_settings_panel',
		array(
			'priority'       => 4,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          =>esc_html__( 'Header Settings', 'eggnews-pro' ),
		)
	);
	/*----------------------------------------------------------------------------------------------------*/
	/**
	 * Top Header Section
	 */
	$wp_customize->add_section(
		'eggnews_top_header_section',
		array(
			'title'    => esc_html__( 'Top Header Section', 'eggnews-pro' ),
			'priority' => 5,
			'panel'    => 'eggnews_header_settings_panel'
		)
	);

	//Ticker display option
	$wp_customize->add_setting(
		'eggnews_ticker_option',
		array(
			'default'           => 'enable',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'eggnews_enable_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
			$wp_customize,
			'eggnews_ticker_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'News Ticker Option', 'eggnews-pro' ),
				'description' => esc_html__( 'Enable/disable news ticker at header.', 'eggnews-pro' ),
				'priority'    => 4,
				'section'     => 'eggnews_top_header_section',
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'eggnews-pro' ),
					'disable' => esc_html__( 'Disable', 'eggnews-pro' )
				)
			)
		)
	);


	$category_choices = array(
		0 => __( 'default', 'eggnews-pro' )
	);

	$categories = get_terms( 'category' ); // Get all Categories

	foreach ( $categories as $category ) {

		if ( isset( $category->term_id ) ) {

			$category_choices[ $category->term_id ] = $category->name;
		}

	}

	// Ticker Category
	$wp_customize->add_setting(
		'eggnews_ticker_category',
		array(
			'default'           => 0,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_sanitize_number',
		)
	);
	$wp_customize->add_control(
		'eggnews_ticker_category',
		array(
			'type'     => 'select',
			'label'    => esc_html__( 'Ticker Category', 'eggnews-pro' ),
			'section'  => 'eggnews_top_header_section',
			'priority' => 5,
			'choices'  => $category_choices

		)
	);	
	// Number of posts on ticker
	$wp_customize->add_setting(
		'eggnews_ticker_number_of_post',
		array(
			'default'           => 5,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_sanitize_number',
		)
	);
	$wp_customize->add_control(
		'eggnews_ticker_number_of_post',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Number of ticker posts', 'eggnews-pro' ),
			'section'  => 'eggnews_top_header_section',
			'priority' => 6
		)
	);
	//Ticker Caption
	$wp_customize->add_setting(
		'eggnews_ticker_caption',
		array(
			'default'           => esc_html__( 'Latest', 'eggnews-pro' ),
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'eggnews_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'eggnews_ticker_caption',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'News Ticker Caption', 'eggnews-pro' ),
			'section'  => 'eggnews_top_header_section',
			'priority' => 7
		)
	);
	// Display Current Date
	$wp_customize->add_setting(
		'eggnews_header_date',
		array(
			'default'           => 'enable',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'eggnews_enable_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
			$wp_customize,
			'eggnews_header_date',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Current Date Option', 'eggnews-pro' ),
				'description' => esc_html__( 'Enable/disable current date from top header.', 'eggnews-pro' ),
				'priority'    => 8,
				'section'     => 'eggnews_top_header_section',
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'eggnews-pro' ),
					'disable' => esc_html__( 'Disable', 'eggnews-pro' )
				)
			)
		)
	);

	/**                 
		* Date format option
		* @package Theme Egg                 
		* @subpackage eggnews-pro                 
		* @since 1.3.0   
	*/ 
	$wp_customize->add_setting(
		'eggnews_date_format_option', array(
		'sanitize_callback' => 'eggnews_sanitize_date_format',
		)
	);
	$wp_customize->add_control(
		'eggnews_date_format_option', array(
			'type'        => 'radio',
			'label'       =>esc_html__( 'Current Date Format Style Option', 'eggnews-pro' ),
			'description' => esc_html__( 'Choose available format for date format style. (functions only if current date option is enabled)', 'eggnews-pro' ),
			'section'     => 'eggnews_top_header_section',
			'choices'     => array(
				'l, F d, Y' => esc_html__( 'Format 1 (dd,mm,yy)', 'eggnews-pro' ),
				'l, Y, F d' => esc_html__( 'Format 2 (dd,yy,mm)', 'eggnews-pro' ),
				'Y, F d, l' => esc_html__( 'Format 3 (yy,mm,dd)', 'eggnews-pro' ),
			),
			'priority'    => 8
		)
	);

	// Option about top header social icons
	$wp_customize->add_setting(
		'eggnews_header_social_option',
		array(
			'default'           => 'enable',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'eggnews_enable_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
			$wp_customize,
			'eggnews_header_social_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Social Icon Option', 'eggnews-pro' ),
				'description' => esc_html__( 'Enable/disable social icons from top header (right).', 'eggnews-pro' ),
				'priority'    => 9,
				'section'     => 'eggnews_top_header_section',
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'eggnews-pro' ),
					'disable' => esc_html__( 'Disable', 'eggnews-pro' )
				)
			)
		)
	);
	/*----------------------------------------------------------------------------------------------------*/
	/**
	 * Sticky Header
	 */
	$wp_customize->add_section(
		'eggnews_sticky_header_section',
		array(
			'title'    => esc_html__( 'Sticky Menu', 'eggnews-pro' ),
			'priority' => 10,
			'panel'    => 'eggnews_header_settings_panel'
		)
	);

	//Sticky header option
	$wp_customize->add_setting(
		'eggnews_sticky_option',
		array(
			'default'           => 'enable',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_enable_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
			$wp_customize,
			'eggnews_sticky_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Menu Sticky', 'eggnews-pro' ),
				'description' => esc_html__( 'Enable/disable option for Menu Sticky', 'eggnews-pro' ),
				'priority'    => 4,
				'section'     => 'eggnews_sticky_header_section',
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'eggnews-pro' ),
					'disable' => esc_html__( 'Disable', 'eggnews-pro' )
				)
			)
		)
	);

    //
    /**
     * Banner Ad settings
     */
    $wp_customize->add_section(
        'eggnews_banner_ads_section',
        array(
            'title' => esc_html__('Banner Ads Section', 'eggnews-pro'),
            'priority' => 11,
            'panel' => 'eggnews_header_settings_panel'
        )
    );

    //Adsence Option
    $wp_customize->add_setting(
        'eggnews_google_ad_option',
        array(
            'default' => 'disable',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'eggnews_enable_switch_sanitize'
        )
    );
    $wp_customize->add_control(new Eggnews_Customize_Switch_Control(
            $wp_customize,
            'eggnews_google_ad_option',
            array(
                'type' => 'switch',
                'label' => esc_html__('Google Ads', 'eggnews-pro'),
                'description' => esc_html__('Enable/disable responsive google ad (adsence) on banner. Please enable only if you want to show responsive google ad on banner ads section.', 'eggnews-pro'),
                'priority' => 4,
                'section' => 'eggnews_banner_ads_section',
                'choices' => array(
                    'enable' => esc_html__('Enable', 'eggnews-pro'),
                    'disable' => esc_html__('Disable', 'eggnews-pro')
                )
            )
        )
    );

	/*----------------------------------------------------------------------------------------------------*/
	/**
	 * Sticky Header
	 */
	$wp_customize->add_section(
		'eggnews_header_icons_section',
		array(
			'title'    => esc_html__( 'Header Icons', 'eggnews-pro' ),
			'priority' => 11,
			'panel'    => 'eggnews_header_settings_panel'
		)
	);

	//Sticky header option
	$wp_customize->add_setting(
		'eggnews_home_option',
		array(
			'default'           => 'enable',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_enable_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
			$wp_customize,
			'eggnews_home_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Home Icon', 'eggnews-pro' ),
				'description' => esc_html__( 'Enable/disable option for Home Icon', 'eggnews-pro' ),
				'priority'    => 4,
				'section'     => 'eggnews_header_icons_section',
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'eggnews-pro' ),
					'disable' => esc_html__( 'Disable', 'eggnews-pro' )
				)
			)
		)
	);
	
	$wp_customize->add_setting(
		'eggnews_search_option',
		array(
			'default'           => 'enable',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_enable_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
			$wp_customize,
			'eggnews_search_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Search Icon', 'eggnews-pro' ),
				'description' => esc_html__( 'Enable/disable option for Search Icon', 'eggnews-pro' ),
				'priority'    => 4,
				'section'     => 'eggnews_header_icons_section',
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'eggnews-pro' ),
					'disable' => esc_html__( 'Disable', 'eggnews-pro' )
				)
			)
		)
	);

	$wp_customize->add_setting(
		'eggnews_random_post_option',
		array(
			'default'           => 'enable',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_enable_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
			$wp_customize,
			'eggnews_random_post_option',
			array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Random Post Icon', 'eggnews-pro' ),
				'description' => esc_html__( 'Enable/disable option for Random Post Icon', 'eggnews-pro' ),
				'priority'    => 4,
				'section'     => 'eggnews_header_icons_section',
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'eggnews-pro' ),
					'disable' => esc_html__( 'Disable', 'eggnews-pro' )
				)
			)
		)
	);	


/**                 
		* Home/Search/Random and Nav icon picker option
		* @package Theme Egg                 
		* @subpackage eggnews-pro                 
		* @since 1.3.0   
	*/ 
$wp_customize->add_setting(
		'eggnews_home_icon_option',
		array(
			'transport'         => 'postMessage',
			'default'           => 'fa fa-home',
 			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_sanitize_icon_picker'
		)
);

	$wp_customize->add_control( new Eggnews_Icon_Picker_Control(
			$wp_customize,
			'eggnews_home_icon_option',
			array(
				'type'        => 'icon_picker',
				'label'       => esc_html__( 'Home Icon Change Option', 'eggnews-pro' ),
				'description' => esc_html__( 'Pick home icon for your website', 'eggnews-pro' ),
				'priority'    => 4,
				'section'     => 'eggnews_header_icons_section',
				
			)
		)
	);
	 

	//Search icon picker 	
	$wp_customize->add_setting(
		'eggnews_search_icon_option',
		array(
			'transport'         => 'postMessage',
			'default'           => 'fa fa-search',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_sanitize_icon_picker'
		)
	);

	$wp_customize->add_control( new Eggnews_Icon_Picker_Control(
			$wp_customize,
			'eggnews_search_icon_option',
			array(
				'type'        => 'icon_picker',
				'label'       => esc_html__( 'Search Icon Change Option', 'eggnews-pro' ),
				'description' => esc_html__( 'Pick search icon for your website', 'eggnews-pro' ),
				'priority'    => 4,
				'section'     => 'eggnews_header_icons_section',
				
			)
		)
	);	


    //Random icon picker 	
	$wp_customize->add_setting(
		'eggnews_random_icon_option',
		array(
			'transport'         => 'postMessage',
			'default'           => 'fa fa-random',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_sanitize_icon_picker'
		)
	);

	$wp_customize->add_control( new Eggnews_Icon_Picker_Control(
			$wp_customize,
			'eggnews_random_icon_option',
			array(
				'type'        => 'icon_picker',
				'label'       => esc_html__( 'Random Icon Change Option', 'eggnews-pro' ),
				'description' => esc_html__( 'Pick random icon for your website', 'eggnews-pro' ),
				'priority'    => 4,
				'section'     => 'eggnews_header_icons_section',
				
		)	
		)
	);	

	 //Nav icon picker 	
	$wp_customize->add_setting(
		'eggnews_nav_icon_option',
		array(
			'transport'         => 'postMessage',
			'default'           => 'fa fa-navicon',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_sanitize_icon_picker'
		)
	);

	$wp_customize->add_control( new Eggnews_Icon_Picker_Control(
		$wp_customize,
		'eggnews_nav_icon_option',
		array(
			'type'        => 'icon_picker',
			'label'       => esc_html__( 'Navigation Icon Change Option', 'eggnews-pro' ),
			'description' => esc_html__( 'Pick Nav icon for your website on mobile/tablet', 'eggnews-pro' ),
			'priority'    => 4,
			'section'     => 'eggnews_header_icons_section',
		)	
	)
);	
}