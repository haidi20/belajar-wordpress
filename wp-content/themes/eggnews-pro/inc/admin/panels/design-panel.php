<?php

/**
 * Customizer option for Design Settings
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */
add_action( 'customize_register', 'eggnews_design_settings_register' );

function eggnews_design_settings_register( $wp_customize ) {

	/**
	 * Add Design Panel
	 */
	$wp_customize->add_panel(
		'eggnews_design_settings_panel', array(
			'priority'       => 6,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Design Settings', 'eggnews-pro' ),
		)
	);

	/* ---------------------------------------------------------------------------
	/**
	 * Archive page Settings
	 */
	$wp_customize->add_section(
		'eggnews_archive_section', array(
			'title'    => esc_html__( 'Archive Settings', 'eggnews-pro' ),
			'priority' => 10,
			'panel'    => 'eggnews_design_settings_panel'
		)
	);

	// Archive page sidebar
	$wp_customize->add_setting(
		'eggnews_archive_sidebar', array(
			'default'           => 'right_sidebar',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_page_layout_sanitize',
		)
	);

	$wp_customize->add_control(
		new Eggnews_Image_Radio_Control(
			$wp_customize, 'eggnews_archive_sidebar', array(
				'type'        => 'radio',
				'label'       => esc_html__( 'Available Sidebars', 'eggnews-pro' ),
				'description' => esc_html__( 'Select sidebar for whole site archives, categories, search page etc.', 'eggnews-pro' ),
				'section'     => 'eggnews_archive_section',
				'priority'    => 4,
				'choices'     => array(
					'right_sidebar'     => get_template_directory_uri() . '/inc/admin/assets/images/right-sidebar.png',
					'left_sidebar'      => get_template_directory_uri() . '/inc/admin/assets/images/left-sidebar.png',
					'no_sidebar'        => get_template_directory_uri() . '/inc/admin/assets/images/no-sidebar.png',
					'no_sidebar_center' => get_template_directory_uri() . '/inc/admin/assets/images/no-sidebar-center.png',
				)
			)
		)
	);

	/**                 
		* Date of post, author, comment, category, view (show/hide option for archive page)
		* @package Theme Egg                 
		* @subpackage eggnews-pro                 
		* @since 1.3.0   
	*/ 

	// Show hide category on archive page
	$wp_customize->add_setting(
		'show_hide_archive_category', array(
			'default'           => 'show',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_show_switch_sanitize',
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
		$wp_customize, 'show_hide_archive_category', array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Category Option', 'eggnews-pro' ),
			'description' => esc_html__( 'Show/Hide category name of the post at archive page.', 'eggnews-pro' ),
			'priority'    => 4,
			'section'     => 'eggnews_archive_section',
			'choices'     => array(
				'show'  => esc_html__( 'Show', 'eggnews-pro' ),
				'hide' => esc_html__( 'Hide', 'eggnews-pro' )
			)
		)
	)
);

	// Show hide view counter on archive page
	$wp_customize->add_setting(
		'eggnews_archive_view_counter_option', array(
			'default'           => 'hide',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'eggnews_show_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
		$wp_customize, 'eggnews_archive_view_counter_option', array(
			'type'        => 'switch',
			'label'       => __( 'View Counter Option', 'eggnews-pro' ),
			'description' => __( 'Show/Hide post view counter at archive page.', 'eggnews-pro' ),
			'priority'    => 5,
			'section'     => 'eggnews_archive_section',
			'choices'     => array(
				'show' => __( 'Show', 'eggnews-pro' ),
				'hide' => __( 'Hide', 'eggnews-pro' )
			)
		)
	)
);
	// Show hide comments on archive
	$wp_customize->add_setting(
		'show_hide_archive_comment', array(
			'default'           => 'show',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_show_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
		$wp_customize, 'show_hide_archive_comment', array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Comment Counter Option', 'eggnews-pro' ),
			'description' => esc_html__( 'Show/Hide comment counter at archive page.', 'eggnews-pro' ),
			'priority'    => 5,
			'section'     => 'eggnews_archive_section',
			'choices'     => array(
				'show' => esc_html__( 'Show', 'eggnews-pro' ),
				'hide' => esc_html__( 'Hide', 'eggnews-pro' )
			)
		)
	)
);
	// Show hide date and author at archive
	$wp_customize->add_setting(
		'show_hide_archive_date_author', array(
			'default'           => 'show',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_show_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
		$wp_customize, 'show_hide_archive_date_author', array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Date of Post and Author Option', 'eggnews-pro' ),
			'description' => esc_html__( 'Show/Hide date of the post and author at archive page.', 'eggnews-pro' ),
			'priority'    => 5,
			'section'     => 'eggnews_archive_section',
			'choices'     => array(
				'show' => esc_html__( 'Show', 'eggnews-pro' ),
				'hide' => esc_html__( 'Hide', 'eggnews-pro' )
			)
		)
	)
);	

	//Archive page layouts
	$wp_customize->add_setting(
		'eggnews_archive_layout', array(
			'default'           => 'classic',
			'sanitize_callback' => 'eggnews_sanitize_archive_layout',
		)
	);
	$wp_customize->add_control(
		'eggnews_archive_layout', array(
			'type'        => 'radio',
			'label'       => esc_html__( 'Archive Page Layout', 'eggnews-pro' ),
			'description' => esc_html__( 'Choose available layout for all archive pages.', 'eggnews-pro' ),
			'section'     => 'eggnews_archive_section',
			'choices'     => array(
				'classic' => esc_html__( 'Classic Layout', 'eggnews-pro' ),
				'columns' => esc_html__( 'Columns Layout', 'eggnews-pro' )
			),
			'priority'    => 5
		)
	);

	//Categories page layouts
	$wp_customize->add_setting(
		'eggnews_categories_slider', array(
			'default'           => '0',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'eggnews_categories_slider', array(
			'type'        => 'radio',
			'label'       => esc_html__( 'Categories Featured', 'eggnews-pro' ),
			'description' => esc_html__( 'Show featured slider on category?.', 'eggnews-pro' ),
			'section'     => 'eggnews_archive_section',
			'choices'     => array(
				'0' => esc_html__( 'No', 'eggnews-pro' ),
				'1' => esc_html__( 'Yes', 'eggnews-pro' )
			),
			'priority'    => 5
		)
	);

	/**                 
		* Show hide feature for category , date of post , author and comment for single post page               
		* @package Theme Egg                 
		* @subpackage eggnews-pro                 
		* @since 1.3.0 
	*/ 

	$wp_customize->add_section(
		'eggnews_single_post_section', array(
			'title'    => esc_html__( 'Post Settings', 'eggnews-pro' ),
			'priority' => 15,
			'panel'    => 'eggnews_design_settings_panel'
		)
	);

	// Single post sidebar
	$wp_customize->add_setting(
		'eggnews_default_post_sidebar', array(
			'default'           => 'right_sidebar',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_page_layout_sanitize',
		)
	);

	$wp_customize->add_control( new Eggnews_Image_Radio_Control(
		$wp_customize, 'eggnews_default_post_sidebar', array(
			'type'        => 'radio',
			'label'       => esc_html__( 'Available Sidebars', 'eggnews-pro' ),
			'description' => esc_html__( 'Select sidebar for whole single post page.', 'eggnews-pro' ),
			'section'     => 'eggnews_single_post_section',
			'priority'    => 4,
			'choices'     => array(
				'right_sidebar'     => get_template_directory_uri() . '/inc/admin/assets/images/right-sidebar.png',
				'left_sidebar'      => get_template_directory_uri() . '/inc/admin/assets/images/left-sidebar.png',
				'no_sidebar'        => get_template_directory_uri() . '/inc/admin/assets/images/no-sidebar.png',
				'no_sidebar_center' => get_template_directory_uri() . '/inc/admin/assets/images/no-sidebar-center.png'
			)
		)
	)
);
	//Sticky sidebar on post
		$wp_customize->add_setting(
			'eggnews_sticky_sidebar_on_single_post', array(
				'default'           => 'disable',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'eggnews_enable_switch_sanitize'
			)
		);
		$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
			$wp_customize, 'eggnews_sticky_sidebar_on_single_post', array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Sticky Sidebar on Post', 'eggnews-pro' ),
				'description' => esc_html__( 'Enable/disable sticky sidebar on single post.', 'eggnews-pro' ),
				'priority'    => 21,
				'section'     => 'eggnews_single_post_section',
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'eggnews-pro' ),
					'disable' => esc_html__( 'Disable', 'eggnews-pro' )
				)
			)
		)
	);	

	//Author box
	$wp_customize->add_setting(
		'eggnews_author_box_option', array(
			'default'           => 'show',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_show_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
		$wp_customize, 'eggnews_author_box_option', array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Author Option', 'eggnews-pro' ),
			'description' => esc_html__( 'Show/Hide author information at single post page.', 'eggnews-pro' ),
			'priority'    => 5,
			'section'     => 'eggnews_single_post_section',
			'choices'     => array(
				'show' => esc_html__( 'Show', 'eggnews-pro' ),
				'hide' => esc_html__( 'Hide', 'eggnews-pro' )
			)
		)
	)
);
		/// Show hide view counter on single post
	$wp_customize->add_setting(
		'eggnews_view_counter_option', array(
			'default'           => 'show',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'eggnews_show_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
		$wp_customize, 'eggnews_view_counter_option', array(
			'type'        => 'switch',
			'label'       => __( 'Post View Counter Option', 'eggnews-pro' ),
			'description' => __( 'Show/Hide post view counter at single post page.', 'eggnews-pro' ),
			'priority'    => 6,
			'section'     => 'eggnews_single_post_section',
			'choices'     => array(
				'show' => __( 'Show', 'eggnews-pro' ),
				'hide' => __( 'Hide', 'eggnews-pro' )
			)
		)
	)
);
	// Show hide category of the post
	$wp_customize->add_setting(
		'eggnews_category_option', array(
			'default'           => 'show',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_show_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
		$wp_customize, 'eggnews_category_option', array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Category Option', 'eggnews-pro' ),
			'description' => esc_html__( 'Show/Hide category name of the post at single post page.', 'eggnews-pro' ),
			'priority'    => 5,
			'section'     => 'eggnews_single_post_section',
			'choices'     => array(
				'show' => esc_html__( 'Show', 'eggnews-pro' ),
				'hide' => esc_html__( 'Hide', 'eggnews-pro' )
			)
		)
	)
);
	// Show hide date and author at the Single post
	$wp_customize->add_setting(
		'eggnews_date_author_option', array(
			'default'           => 'show',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_show_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
		$wp_customize, 'eggnews_date_author_option', array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Date of Post and Author Option', 'eggnews-pro' ),
			'description' => esc_html__( 'Show/Hide date of the post and author at single post page.', 'eggnews-pro' ),
			'priority'    => 5,
			'section'     => 'eggnews_single_post_section',
			'choices'     => array(
				'show' => esc_html__( 'Show', 'eggnews-pro' ),
				'hide' => esc_html__( 'Hide', 'eggnews-pro' )
			)
		)
	)
);
	// Show hide comments count of the post
	$wp_customize->add_setting(
		'eggnews_comment_count_option', array(
			'default'           => 'show',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_show_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
		$wp_customize, 'eggnews_comment_count_option', array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Comment Counter Option', 'eggnews-pro' ),
			'description' => esc_html__( 'Show/Hide comment counter at single post page.', 'eggnews-pro' ),
			'priority'    => 5,
			'section'     => 'eggnews_single_post_section',
			'choices'     => array(
				'show' => esc_html__( 'Show', 'eggnews-pro' ),
				'hide' => esc_html__( 'Hide', 'eggnews-pro' )
			)
		)
	)
);

	// Show hide social sharing icons on single post
	$wp_customize->add_setting(
		'eggnews_social_sharing_option', array(
			'default'           => 'show',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_show_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
		$wp_customize, 'eggnews_social_sharing_option', array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Social Sharing Icon on Single Post', 'eggnews-pro' ),
			'description' => esc_html__( 'Show/Hide social sharing options on single post page.', 'eggnews-pro' ),
			'priority'    => 7,
			'section'     => 'eggnews_single_post_section',
			'choices'     => array(
				'show' => esc_html__( 'Show', 'eggnews-pro' ),
				'hide' => esc_html__( 'Hide', 'eggnews-pro' )
			)
		)
	)
);

	//Show hide/feature image on single page
	$wp_customize->add_setting(
		'eggnews_show_hide_feature_on_singe_post', array(
			'default'           => 'show',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_show_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
		$wp_customize, 'eggnews_show_hide_feature_on_singe_post', array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Feature Images', 'eggnews-pro' ),
			'description' => esc_html__( 'Show/Hide feature images at single post page.', 'eggnews-pro' ),
			'priority'    => 7,
			'section'     => 'eggnews_single_post_section',
			'choices'     => array(
				'show' => esc_html__( 'Show', 'eggnews-pro' ),
				'hide' => esc_html__( 'Hide', 'eggnews-pro' )
			)
		)
	)
);

	//Related Articles
	$wp_customize->add_setting(
		'eggnews_related_articles_option', array(
			'default'           => 'enable',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_enable_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
		$wp_customize, 'eggnews_related_articles_option', array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Related Articles Option', 'eggnews-pro' ),
			'description' => esc_html__( 'Enable/disable related articles section at single post page.', 'eggnews-pro' ),
			'priority'    => 8,
			'section'     => 'eggnews_single_post_section',
			'choices'     => array(
				'enable'  => esc_html__( 'Enable', 'eggnews-pro' ),
				'disable' => esc_html__( 'Disable', 'eggnews-pro' )
			)
		)
	)
);

	//Related articles section title
	$wp_customize->add_setting(
		'eggnews_related_articles_title', array(
			'default'           => esc_html__( 'Related Articles', 'eggnews-pro' ),
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'eggnews_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'eggnews_related_articles_title', array(
			'type'            => 'text',
			'label'           => esc_html__( 'Section Title', 'eggnews-pro' ),
			'section'         => 'eggnews_single_post_section',
			'active_callback' => 'eggnews_related_articles_option_callback',
			'priority'        => 9
		)
	);

	// Types of Related articles
	$wp_customize->add_setting(
		'eggnews_related_articles_type', array(
			'default'           => 'category',
			'sanitize_callback' => 'eggnews_sanitize_related_type',
		)
	);
	$wp_customize->add_control(
		'eggnews_related_articles_type', array(
			'type'            => 'radio',
			'label'           => esc_html__( 'Types of Related Articles', 'eggnews-pro' ),
			'description'     => esc_html__( 'Option to display related articles from category/tags.', 'eggnews-pro' ),
			'section'         => 'eggnews_single_post_section',
			'choices'         => array(
				'category' => esc_html__( 'by Category', 'eggnews-pro' ),
				'tag'      => esc_html__( 'by Tags', 'eggnews-pro' )
			),
			'active_callback' => 'eggnews_related_articles_option_callback',
			'priority'        => 10
		)
	);
	
	/* -------------------------------------------------------------------------------- */
	/**
	 * Single page Settings
	 */
	$wp_customize->add_section(
		'eggnews_single_page_section', array(
			'title'    => esc_html__( 'Page Settings', 'eggnews-pro' ),
			'priority' => 20,
			'panel'    => 'eggnews_design_settings_panel'
		)
	);

	// Archive page sidebar
	$wp_customize->add_setting(
		'eggnews_default_page_sidebar', array(
			'default'           => 'right_sidebar',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_page_layout_sanitize',
		)
	);

	$wp_customize->add_control( new Eggnews_Image_Radio_Control(
		$wp_customize, 'eggnews_default_page_sidebar', array(
			'type'        => 'radio',
			'label'       => esc_html__( 'Available Sidebars', 'eggnews-pro' ),
			'description' => esc_html__( 'Select sidebar for whole single page.', 'eggnews-pro' ),
			'section'     => 'eggnews_single_page_section',
			'priority'    => 4,
			'choices'     => array(
				'right_sidebar'     => get_template_directory_uri() . '/inc/admin/assets/images/right-sidebar.png',
				'left_sidebar'      => get_template_directory_uri() . '/inc/admin/assets/images/left-sidebar.png',
				'no_sidebar'        => get_template_directory_uri() . '/inc/admin/assets/images/no-sidebar.png',
				'no_sidebar_center' => get_template_directory_uri() . '/inc/admin/assets/images/no-sidebar-center.png'
			)
		)
	)
);


	//Show hide/feature image on single page
	$wp_customize->add_setting(
		'eggnews_show_hide_feature_on_singe_page', array(
			'default'           => 'show',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_show_switch_sanitize'
		)
	);
	$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
		$wp_customize, 'eggnews_show_hide_feature_on_singe_page', array(
			'type'        => 'switch',
			'label'       => esc_html__( 'Feature Images', 'eggnews-pro' ),
			'description' => esc_html__( 'Enable/disable feature images at single page.', 'eggnews-pro' ),
			'priority'    => 5,
			'section'     => 'eggnews_single_page_section',
			'choices'     => array(
				'show' => esc_html__( 'Show', 'eggnews-pro' ),
				'hide' => esc_html__( 'Hide', 'eggnews-pro' )
			)
		)
	)
);
		//Sticky sidebar on page
		$wp_customize->add_setting(
			'eggnews_sticky_sidebar_on_page', array(
				'default'           => 'disable',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'eggnews_enable_switch_sanitize'
			)
		);
		$wp_customize->add_control( new Eggnews_Customize_Switch_Control(
			$wp_customize, 'eggnews_sticky_sidebar_on_page', array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Sticky Sidebar on page ', 'eggnews-pro' ),
				'description' => esc_html__( 'Enable/disable sticky sidebar on page.', 'eggnews-pro' ),
				'priority'    => 21,
				'section'     => 'eggnews_single_page_section',
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'eggnews-pro' ),
					'disable' => esc_html__( 'Disable', 'eggnews-pro' )
				)
			)
		)
	);			

	/* -------------------------------------------------------------------------------------------------------- */
	/**
	 * Footer widget area
	 */
	$wp_customize->add_section(
		'eggnews_footer_widget_section', array(
			'title'    => esc_html__( 'Footer Settings', 'eggnews-pro' ),
			'priority' => 25,
			'panel'    => 'eggnews_design_settings_panel'
		)
	);
	// Footer widget area
	$wp_customize->add_setting(
		'footer_widget_option', array(
			'default'           => 'column3',
			'sanitize_callback' => 'eggnews_footer_widget_sanitize',
		)
	);
	$wp_customize->add_control(
		'footer_widget_option', array(
			'type'        => 'radio',
			'priority'    => 4,
			'label'       => esc_html__( 'Top Footer Widget Area', 'eggnews-pro' ),
			'description' => esc_html__( 'Choose option to display number of columns in top footer area.', 'eggnews-pro' ),
			'section'     => 'eggnews_footer_widget_section',
			'choices'     => array(
				'column1' => esc_html__( 'One Column', 'eggnews-pro' ),
				'column2' => esc_html__( 'Two Columns', 'eggnews-pro' ),
				'column3' => esc_html__( 'Three Columns', 'eggnews-pro' ),
				'column4' => esc_html__( 'Four Columns', 'eggnews-pro' ),
			),
		)
	);
	// Footer widget area
	$wp_customize->add_setting(
		'middle_footer_widget_option', array(
			'default'           => 'column4',
			'sanitize_callback' => 'eggnews_middle_footer_widget_sanitize',
		)
	);
	$wp_customize->add_control(
		'middle_footer_widget_option', array(
			'type'        => 'radio',
			'priority'    => 4,
			'label'       => esc_html__( 'Middle Footer Widget Area', 'eggnews-pro' ),
			'description' => esc_html__( 'Choose option to display number of columns in middle footer area.', 'eggnews-pro' ),
			'section'     => 'eggnews_footer_widget_section',
			'choices'     => array(
				'column1' => esc_html__( 'One Column', 'eggnews-pro' ),
				'column2' => esc_html__( 'Two Columns', 'eggnews-pro' ),
				'column3' => esc_html__( 'Three Columns', 'eggnews-pro' ),
				'column4' => esc_html__( 'Four Columns', 'eggnews-pro' ),
			),
		)
	);

	$footer_copywrite = esc_html__( 'Copyright &copy; ', 'eggnews-pro' ) . '[the-year] [site-url]. All rights reserved. ' . __( 'Theme: EggNews Pro by ', 'eggnews-pro' ) . '[teg-url]. ' . __( 'Powered by ', 'eggnews-pro' ) . '[wp-url]';

	//Copyright text
	$wp_customize->add_setting(
		'eggnews_copyright_text', array(
			'default'           => $footer_copywrite,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'eggnews_footer_editor_sanitize',
		)
	);
	$wp_customize->add_control(
		'eggnews_copyright_text', array(
			'type'     => 'textarea',
			'label'    => esc_html__( 'Change your Copywrite info in your footer. You can use shortcode too. Example : [the-year], [site-url], [wp-url], [teg-url]', 'eggnews-pro' ),
			'section'  => 'eggnews_footer_widget_section',
			'priority' => 5
		)
	);

	//Website Skin
	$wp_customize->add_section(
		'eggnews_website_skin_section',
		array(
			'title'    => esc_html__( 'Website Skin', 'eggnews-pro' ),
			'priority' => 26,
			'panel'    => 'eggnews_design_settings_panel'
		)
	);
	// Website Skin Setting
	$wp_customize->add_setting(
		'website_skin_option',
		array(
			'default'           => 'default_skin',
			'sanitize_callback' => 'eggnews_website_skin_sanitize',
		)
	);
	$wp_customize->add_control(
		'website_skin_option',
		array(
			'type'        => 'radio',
			'priority'    => 4,
			'label'       => esc_html__( 'Choose Website Skin', 'eggnews-pro' ),
			'description' => esc_html__( 'Choose the  skin color for your site.', 'eggnews-pro' ),
			'section'     => 'eggnews_website_skin_section',
			'choices'     => eggnews_website_skin(),
		)
	);

	// Image Settings

	//Website Skin
	$wp_customize->add_section(
		'eggnews_website_image_section',
		array(
			'title'    => esc_html__( 'Image Settings', 'eggnews-pro' ),
			'priority' => 27,
			'panel'    => 'eggnews_design_settings_panel'
		)
	);
	// Website Image Hover setting
	$wp_customize->add_setting(
		'eggnews_website_image_hover_option',
		array(
			'default'           => 'default',
			'sanitize_callback' => 'eggnews_website_image_hover_sanitize',
		)
	);
	$wp_customize->add_control(
		'eggnews_website_image_hover_option',
		array(
			'type'        => 'radio',
			'priority'    => 4,
			'label'       => esc_html__( 'Select Image Hover Option', 'eggnews-pro' ),
			'description' => esc_html__( 'Choose the  hover effect of image.', 'eggnews-pro' ),
			'section'     => 'eggnews_website_image_section',
			'choices'     => eggnews_website_hover_option(),
		)
	);

	/* --------------------------------------------------------------------------------------------------------------- */
	/**
	 * Title Style
	 */
	$wp_customize->add_section(
		'eggnews_site_title_design', array(
			'title'       => esc_html__( 'Title Style', 'eggnews-pro' ),
			'description' => esc_html__( 'Design option of title style', 'eggnews-pro' ),
			'priority'    => 26,
			'panel'       => 'eggnews_design_settings_panel',
		)
	);

	$wp_customize->add_setting(
		'site_title_design_options', array(
			'default'           => 'default',
			'sanitize_callback' => 'eggnews_sanitize_title_design',
		)
	);
	$wp_customize->add_control(
		'site_title_design_options', array(
			'type'     => 'radio',
			'priority' => 10,
			'label'    => esc_html__( 'Title design styles', 'eggnews-pro' ),
			'section'  => 'eggnews_site_title_design',
			'choices'  => eggnews_site_title_design(),
		)
	);

	$wp_customize->add_setting(
		'view_all_text_options', array(
			'default'           => esc_html__( 'View All', 'eggnews-pro' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'view_all_text_options', array(
			'type'     => 'text',
			'priority' => 10,
			'label'    => esc_html__( 'View All Text', 'eggnews-pro' ),
			'section'  => 'eggnews_site_title_design',
		)
	);

	$wp_customize->add_section(
		'eggnews_breadcrumb_options', array(
			'title'       => esc_html__( 'Breadcrumb', 'eggnews-pro' ),
			'description' => esc_html__( 'Breadcrumb options', 'eggnews-pro' ),
			'priority'    => 33,
			'panel'       => 'eggnews_design_settings_panel',
		)
	);

	$wp_customize->add_setting(
		'eggnews_enable_breadcrumb', array(
			'default'           => 'yes',
			'sanitize_callback' => 'eggnews_sanitize_enable_breadcrumb',
		)
	);
	$wp_customize->add_control(
		'eggnews_enable_breadcrumb', array(
			'type'     => 'radio',
			'priority' => 10,
			'label'    => esc_html__( 'Enable breadcrumb', 'eggnews-pro' ),
			'section'  => 'eggnews_breadcrumb_options',
			'choices'  => array(
				'yes' => esc_html__( 'Yes', 'eggnews-pro' ),
				'no'  => esc_html__( 'No', 'eggnews-pro' ),
			)
		)
	);

	$wp_customize->add_setting(
		'eggnews_breadcrumb_layout', array(
			'default' => 'layout1',
		)
	);

	$wp_customize->add_control(
		'eggnews_breadcrumb_layout', array(
			'type'     => 'radio',
			'priority' => 10,
			'label'    => esc_html__( 'Enable breadcrumb', 'eggnews-pro' ),
			'section'  => 'eggnews_breadcrumb_options',
			'choices'  => array(
				'layout1' => esc_html__( 'Default', 'eggnews-pro' ),
				'layout2' => esc_html__( 'Layout 2', 'eggnews-pro' ),
			)
		)
	);

	$wp_customize->add_section(
		'eggnews_header_style', array(
			'title'       => esc_html__( 'Header Style', 'eggnews-pro' ),
			'description' => esc_html__( 'Choose header layout style.', 'eggnews-pro' ),
			'priority'    => 22,
			'panel'       => 'eggnews_design_settings_panel',
		)
	);
	//Archive page layouts
	$wp_customize->add_setting(
		'eggnews_header_style_option', array(
			'default'           => 'style-1',
			'sanitize_callback' => 'eggnews_sanitize_header_style',
		)
	);
	$wp_customize->add_control(
		'eggnews_header_style_option', array(
			'type'        => 'radio',
			'label'       =>esc_html__( 'Header layout style', 'eggnews-pro' ),
			'description' => esc_html__( 'Choose available layout for header style.', 'eggnews-pro' ),
			'section'     => 'eggnews_header_style',
			'choices'     => array(
				'style-1' => esc_html__( 'Style 1 (Default style)', 'eggnews-pro' ),
				'style-2' => esc_html__( 'Style 2 (Ticker below menu)', 'eggnews-pro' ),
				'style-3' => esc_html__( 'Style 3 (Hide Top Header)', 'eggnews-pro' ),
				'style-4' => esc_html__( 'Style 4 (Center logo and banner adv.)', 'eggnews-pro' ),
			),
			'priority'    => 5
		)
	);

	//Hide Top Header Date
	$wp_customize->add_setting(
		'eggnews_hide_top_header_date', array(
			'default'           => 0,
			'sanitize_callback' => 'eggnews_hide_header_date',
		)
	);
	$wp_customize->add_control(
		'eggnews_hide_top_header_date', array(
			'type'        => 'radio',
			'label'       => esc_html__( 'Hide Top Header Date?', 'eggnews-pro' ),
			'description' => esc_html__( 'Check to hide top header date', 'eggnews-pro' ),
			'section'     => 'eggnews_header_style',
			'choices'     => array(
				'1' => __( 'Yes', 'eggnews-pro' ),
				'0' => __( 'No', 'eggnews-pro' ),
			),
			'priority'    => 5
		)
	);
	


	/**                 
		* Parallax Feature                 
		* @package Theme Egg                 
		* @subpackage eggnews-pro                 
		* @since 1.2.0   
	*/ 
		$wp_customize->add_setting(
			'parallax_footer_eggnews', 
			array(   
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(  
			new WP_Customize_Image_Control(
				$wp_customize,
				'parallax_footer_eggnews', 
				array(
					'label'      => esc_html__('Upload Parallax Image', 'eggnews-pro' ),
					'description' => esc_html__( 'Upload parallax background image.', 'eggnews-pro' ),               
					'section'    => 'eggnews_footer_widget_section',               
					'settings'   => 'parallax_footer_eggnews',
					'panel'      => 'eggnews_design_settings_panel'
				)       
			)
		);
	}



