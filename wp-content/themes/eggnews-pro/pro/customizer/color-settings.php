<?php
/**
 * Customizer option for Color Settings
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */
function eggnews_color_settings_register( $wp_customize ) {

	/**
	 * Add Color Settings Panel
	 */
	$wp_customize->add_panel(
		'eggnews_color_settings_panel',
		array(
			'priority'       => 6,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => __( 'Color Settings', 'eggnews-pro' ),
		)
	);

	/*--------------------------------------------------------------------------------*/
	/**
	 * Category Color Settings
	 */
	$wp_customize->add_section(
		'eggnews_categories_color_section',
		array(
			'title'    => __( 'Categories Color', 'eggnews-pro' ),
			'priority' => 5,
			'panel'    => 'eggnews_color_settings_panel',
		)
	);

	$priority         = 3;
	$categories       = get_terms( 'category' ); // Get all Categories
	$wp_category_list = array();
	$default          = get_theme_mod( 'eggnews_section_color' );
	foreach ( $categories as $category_list ) {

		$wp_customize->add_setting(
			'eggnews_category_color_' . esc_html( strtolower( $category_list->name ) ),
			array(
				'default'           => '#f25d26',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'eggnews_category_color_' . esc_html( strtolower( $category_list->name ) ),
				array(
					'label'    => sprintf( esc_html__( ' %s', 'eggnews-pro' ), esc_html( $category_list->name ) ),
					'section'  => 'eggnews_categories_color_section',
					'priority' => absint( $priority )
				)
			)
		);
		$priority ++;
	}

	// Color Section.
	$wp_customize->add_section( 'section_color',
		array(
			'title'      => __( 'Color Setting', 'eggnews-pro' ),
			'priority'   => 100,
			'capability' => 'edit_theme_options',
			'panel'      => 'eggnews_color_settings_panel',
		)
	);

	// Body Color
	$wp_customize->add_setting( 'eggnews_section_color[body_color]',
		array(
			'default'           => isset( $default['body_color'] ) ? $default['body_color'] : '#3d3d3d',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[body_color]',
			array(
				'label'       => __( 'Body Color', 'eggnews-pro' ),
				'description' => __( 'Applied to default color of body.', 'eggnews-pro' ),
				'settings'    => 'eggnews_section_color[body_color]',
				'section'     => 'section_color',
			)
		)
	);

	// Heading Color
	$wp_customize->add_setting( 'eggnews_section_color[heading_text_color]',
		array(
			'default'           => isset( $default['heading_text_color'] ) ? $default['heading_text_color'] : '',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[heading_text_color]',
			array(
				'label'    => __( 'Header Text Color[h1-h6]', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[heading_text_color]',
				'section'  => 'section_color',
			)
		)
	);

	// Paragraph Color
	$wp_customize->add_setting( 'eggnews_section_color[paragraph_color]',
		array(
			'default'           => isset( $default['paragraph_color'] ) ? $default['paragraph_color'] : '',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[paragraph_color]',
			array(
				'label'    => __( 'Paragraph Color', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[paragraph_color]',
				'section'  => 'section_color',
			)
		)
	);
	/**                 
		* Preloader background color change option               
		* @package Theme Egg                 
		* @subpackage eggnews-pro                 
		* @since 1.3.0   
	*/ 
	$wp_customize->add_setting( 'eggnews_section_color[preload_background_color]',
		array(
			'default'           => isset( $default['preload_background_color'] ) ? $default['preload_background_color'] : '#ffffff',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[preload_background_color]',
			array(
				'label'    => __( 'Preloader Background Color', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[preload_background_color]',
				'section'  => 'section_color',
			)
		)
	);

	// Top Header Background
	$wp_customize->add_setting( 'eggnews_section_color[top_header_background]',
		array(
			'default'           => isset( $default['top_header_background'] ) ? $default['top_header_background'] : '#313541',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[top_header_background]',
			array(
				'label'    => __( 'Top Header BG Color', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[top_header_background]',
				'section'  => 'section_color',
			)
		)
	);

	// Top Header Color
	$wp_customize->add_setting( 'eggnews_section_color[top_header_color]',
		array(
			'default'           => isset( $default['top_header_color'] ) ? $default['top_header_color'] : '#fff',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[top_header_color]',
			array(
				'label'    => __( 'Top Header Color', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[top_header_color]',
				'section'  => 'section_color',
			)
		)
	);

	// Menu Background Color
	$wp_customize->add_setting( 'eggnews_section_color[menu_background_color]',
		array(
			'default'           => isset( $default['menu_background_color'] ) ? $default['menu_background_color'] : '',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[menu_background_color]',
			array(
				'label'    => __( 'Menu Background Color', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[menu_background_color]',
				'section'  => 'section_color',
			)
		)
	);

	// Menu font Color
	$wp_customize->add_setting( 'eggnews_section_color[menu_text_color]',
		array(
			'default'           => isset( $default['menu_text_color'] ) ? $default['menu_text_color'] : '',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[menu_text_color]',
			array(
				'label'    => __( 'Menu Text Color', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[menu_text_color]',
				'section'  => 'section_color',
			)
		)
	);


	// Block Title Color
	$wp_customize->add_setting( 'eggnews_section_color[block_title_color]',
		array(
			'default'           => isset( $default['block_title_color'] ) ? $default['block_title_color'] : '',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[block_title_color]',
			array(
				'label'    => __( 'Block Title Color', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[block_title_color]',
				'section'  => 'section_color',
			)
		)
	);

	// Sidebar font Color
	$wp_customize->add_setting( 'eggnews_section_color[sidebar_widget_color]',
		array(
			'default'           => isset( $default['sidebar_widget_color'] ) ? $default['sidebar_widget_color'] : '',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[sidebar_widget_color]',
			array(
				'label'    => __( 'Sidebar Font Color', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[sidebar_widget_color]',
				'section'  => 'section_color',
			)
		)
	);

	$wp_customize->add_setting( 'eggnews_section_color[sidebar_link_color]',
		array(
			'default'           => isset( $default['sidebar_link_color'] ) ? $default['sidebar_link_color'] : '',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[sidebar_link_color]',
			array(
				'label'    => __( 'Sidebar Link Color', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[sidebar_link_color]',
				'section'  => 'section_color',
			)
		)
	);

	// Sidebar Title background
	$wp_customize->add_setting( 'eggnews_section_color[sidebar_title_background]',
		array(
			'default'           => isset( $default['sidebar_title_background'] ) ? $default['sidebar_title_background'] : '',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[sidebar_title_background]',
			array(
				'label'    => __( 'Sidebar title background', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[sidebar_title_background]',
				'section'  => 'section_color',
			)
		)
	);

	// Sidebar Title Color
	$wp_customize->add_setting( 'eggnews_section_color[sidebar_title_color]',
		array(
			'default'           => isset( $default['sidebar_title_color'] ) ? $default['sidebar_title_color'] : '',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[sidebar_title_color]',
			array(
				'label'    => __( 'Sidebar title color', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[sidebar_title_color]',
				'section'  => 'section_color',
			)
		)
	);

	// Top Footer Background Color
	$wp_customize->add_setting( 'eggnews_section_color[top_footer_section_background_color]',
		array(
			'default'           => isset( $default['top_footer_section_background_color'] ) ? $default['top_footer_section_background_color'] : '#333743',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[top_footer_section_background_color]',
			array(
				'label'    => __( 'Top footer section background color', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[top_footer_section_background_color]',
				'section'  => 'section_color',
			)
		)
	);
	// Middle Footer  Background  Color
	$wp_customize->add_setting( 'eggnews_section_color[middle_footer_section_background_color]',
		array(
			'default'           => isset( $default['middle_footer_section_background_color'] ) ? $default['middle_footer_section_background_color'] : '#303440',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[middle_footer_section_background_color]',
			array(
				'label'    => __( 'Middle footer section background color', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[middle_footer_section_background_color]',
				'section'  => 'section_color',
			)
		)
	);
	// Buttom Footer  Background  Color
	$wp_customize->add_setting( 'eggnews_section_color[bottom_footer_section_background_color]',
		array(
			'default'           => isset( $default['bottom_footer_section_background_color'] ) ? $default['bottom_footer_section_background_color'] : '#2B2F3A',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[bottom_footer_section_background_color]',
			array(
				'label'    => __( 'Bottom footer section background color', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[bottom_footer_section_background_color]',
				'section'  => 'section_color',
			)
		)
	);

	// Top Footer Widget Background  Color
	$wp_customize->add_setting( 'eggnews_section_color[top_footer_widget_background_color]',
		array(
			'default'           => isset( $default['top_footer_widget_background_color'] ) ? $default['top_footer_widget_background_color'] : '#2c2e34',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[top_footer_widget_background_color]',
			array(
				'label'    => __( 'Top footer widget background color', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[top_footer_widget_background_color]',
				'section'  => 'section_color',
			)
		)
	);
	// Middle Footer Widget Background  Color
	$wp_customize->add_setting( 'eggnews_section_color[middle_footer_widget_background_color]',
		array(
			'default'           => isset( $default['middle_footer_widget_background_color'] ) ? $default['middle_footer_widget_background_color'] : '#303440',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[middle_footer_widget_background_color]',
			array(
				'label'    => __( 'Middle footer widget background color', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[middle_footer_widget_background_color]',
				'section'  => 'section_color',
			)
		)
	);
	// Footer Background  Color
	$wp_customize->add_setting( 'eggnews_section_color[footer_background_color]',
		array(
			'default'           => isset( $default['footer_background_color'] ) ? $default['footer_background_color'] : '',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'eggnews_section_color[footer_background_color]',
			array(
				'label'    => __( 'Copywirte footer background color', 'eggnews-pro' ),
				'settings' => 'eggnews_section_color[footer_background_color]',
				'section'  => 'section_color',
			)
		)
	);

}

add_action( 'customize_register', 'eggnews_color_settings_register' );

//Backend color settings appears in frontend from here
if ( ! function_exists( 'eggnews_pro_color_settings' ) ) :

	/**
	 * add color styling
	 */
	function eggnews_pro_color_settings() {
		$default                               = get_theme_mod( 'eggnews_section_color' );
		$body_color                            = isset( $default['body_color'] ) ? $default['body_color'] : '';
		$heading_text_color                    = isset( $default['heading_text_color'] ) ? $default['heading_text_color'] : '';
		$paragraph_color                       = isset( $default['paragraph_color'] ) ? $default['paragraph_color'] : '';
		$preload_background_color			   = isset( $default['preload_background_color'] ) ? $default['preload_background_color']: '';
		$header_background                     = isset( $default['top_header_background'] ) ? $default['top_header_background'] : '';
		$top_header_color                      = isset( $default['top_header_color'] ) ? $default['top_header_color'] : '';
		$menu_background_color                 = isset( $default['menu_background_color'] ) ? $default['menu_background_color'] : '';
		$menu_text_color                       = isset( $default['menu_text_color'] ) ? $default['menu_text_color'] : '';
		$block_title_color                     = isset( $default['block_title_color'] ) ? $default['block_title_color'] : '';
		$sidebar_widget_color                  = isset( $default['sidebar_widget_color'] ) ? $default['sidebar_widget_color'] : '';
		$sidebar_link_color                    = isset( $default['sidebar_link_color'] ) ? $default['sidebar_link_color'] : '';
		$sidebar_title_background              = isset( $default['sidebar_title_background'] ) ? $default['sidebar_title_background'] : '';
		$sidebar_title_color                   = isset( $default['sidebar_title_color'] ) ? $default['sidebar_title_color'] : '';
		$footer_background_color               = isset( $default['footer_background_color'] ) ? $default['footer_background_color'] : '';
		$top_footer_widget_background_color    = isset( $default['top_footer_widget_background_color'] ) ? $default['top_footer_widget_background_color'] : '#2c2e34';
		$middle_footer_widget_background_color = isset( $default['middle_footer_widget_background_color'] ) ? $default['middle_footer_widget_background_color'] : '#303440';


		$top_footer_section_background_color    = isset( $default['top_footer_section_background_color'] ) ? $default['top_footer_section_background_color'] : '';
		$middle_footer_section_background_color = isset( $default['middle_footer_section_background_color'] ) ? $default['middle_footer_section_background_color'] : '';
		$bottom_footer_section_background_color = isset( $default['bottom_footer_section_background_color'] ) ? $default['bottom_footer_section_background_color'] : '';
		?>
		<style type="text/css">
			body {
				color: <?php echo $body_color; ?>;
			}

			h1, h2, h3, h4, h5, h6 {
				color: <?php echo $heading_text_color; ?>;
			}

			p {
				color: <?php echo $paragraph_color; ?>;
			}

			.top-header-section {
				background: <?php echo $header_background; ?>;
				color: <?php echo $top_header_color; ?>;

			}

			.top-header-section .date-section {
				color: <?php echo $top_header_color; ?>;

			}

			.bottom-header-wrapper,
			.main-navigation ul.children,
			.main-navigation ul.sub-menu,
			.is-sticky .bottom-header-wrapper {
				background: <?php echo $menu_background_color; ?>;
			}

			.main-navigation ul li a {
				color: <?php echo $menu_text_color; ?>;
			}

			.block-header .block-title,
			.related-articles-wrapper .related-title,
			.widget .widget-title,
			#content .block-header h3,
			#content .block-header h3 a,
			#content .widget .widget-title-wrapper h3,
			#content .widget .widget-title-wrapper h3 a,
			#content .related-articles-wrapper .widget-title-wrapper h3,
			#content .related-articles-wrapper .widget-title-wrapper h3 a,
			#content .block-header h4,
			#content .block-header h4 a,
			#content .widget .widget-title-wrapper h4,
			#content .widget .widget-title-wrapper h4 a,
			#content .related-articles-wrapper .widget-title-wrapper h4,
			#content .related-articles-wrapper .widget-title-wrapper h4 a {
				color: <?php echo $block_title_color; ?>;
			}

			#secondary .widget {
				color: <?php echo $sidebar_widget_color; ?>;
			}

			#secondary .widget a {
				color: <?php echo $sidebar_link_color; ?>;
			}

			#secondary .block-header,
			#secondary .widget .widget-title-wrapper,
			#secondary .related-articles-wrapper .widget-title-wrapper {
				background-color: <?php echo eggnews_sass_lighten($sidebar_title_background, 15); ?>;
				border-left-color: <?php echo $sidebar_title_background; ?>;
				border-bottom-color: <?php echo $sidebar_title_background; ?>;
			}

			#secondary .block-header .block-title,
			#secondary .widget .widget-title,
			#secondary .related-articles-wrapper .related-title {
				background-color: <?php echo $sidebar_title_background; ?>;
			}

			#secondary .block-header .block-title::after,
			#secondary .widget .widget-title::after,
			#secondary .related-articles-wrapper .related-title::after {
				border-bottom-color: <?php echo $sidebar_title_background; ?>;
			}

			#secondary .block-header .block-title,
			#secondary .related-articles-wrapper .related-title,
			#secondary .widget .widget-title,
			#secondary .block-header h3,
			#secondary .block-header h3 a,
			#secondary .widget .widget-title-wrapper h3,
			#secondary .widget .widget-title-wrapper h3 a,
			#secondary .related-articles-wrapper .widget-title-wrapper h3,
			#secondary .related-articles-wrapper .widget-title-wrapper h3 a,
			#secondary .block-header h4,
			#secondary .block-header h4 a,
			#secondary .widget .widget-title-wrapper h4,
			#secondary .widget .widget-title-wrapper h4 a,
			#secondary .related-articles-wrapper .widget-title-wrapper h4,
			#secondary .related-articles-wrapper .widget-title-wrapper h4 a {
				color: <?php echo $sidebar_title_color; ?>;
			}

			#bottom-footer {
				background: <?php echo $footer_background_color; ?>;
			}

			#top-footer .teg-footer-widget .widget {
				background: <?php echo $top_footer_widget_background_color; ?>;
			}

			#middle-footer .teg-footer-widget .widget {
				background: <?php echo $middle_footer_widget_background_color; ?>;
			}

			#top-footer {
			<?php if(!empty($top_footer_section_background_color)){
				?> background: <?php echo $top_footer_section_background_color; ?>;
			<?php } ?>
			}

			#middle-footer {
			<?php if(!empty($middle_footer_section_background_color)){
				?> background: <?php echo $middle_footer_section_background_color; ?>;
			<?php } ?>
			}

			#bottom-footer {
			<?php if(!empty($bottom_footer_section_background_color)){
				?> background: <?php echo $bottom_footer_section_background_color; ?>;
			<?php } ?>
			}

		</style>
		<?php
	}

endif;

add_action( 'wp_head', 'eggnews_pro_color_settings' );
