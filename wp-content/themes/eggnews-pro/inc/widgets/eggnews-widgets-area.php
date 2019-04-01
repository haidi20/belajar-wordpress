<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */
function eggnews_widgets_init() {
	$eggnews_sidebar_setting_options = get_theme_mod( 'eggnews_sidebar_setting_options' );
	$left_sidebar_additional_class   = isset( $eggnews_sidebar_setting_options['sidebar_left_is_sticky'] ) && $eggnews_sidebar_setting_options['sidebar_left_is_sticky'] != '0' ? 'sticky-sidebar' : '';
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'eggnews-pro' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'This sidebar will appear only if you choose right sidebar.', 'eggnews-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'eggnews-pro' ),
		'id'            => 'eggnews_left_sidebar',
		'description'   => esc_html__( 'This sidebar will appear only if you choose left sidebar.', 'eggnews-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s '.$left_sidebar_additional_class.'">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Header Ads', 'eggnews-pro' ),
		'id'            => 'eggnews_header_ads_area',
		'description'   => esc_html__( 'This sidebar will appear on header section of a page.', 'eggnews-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Home Page Slider Area', 'eggnews-pro' ),
		'id'            => 'eggnews_home_slider_area',
		'description'   => esc_html__( 'This sidebar will appear below header(after menu) section of News Home Page Template.', 'eggnews-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	// This is pro widget //
	register_sidebar( array(
		'name'          => esc_html__( 'Full Width Above Main Content', 'eggnews-pro' ),
		'id'            => 'eggnews_home_page_full_width',
		'description'   => esc_html__( 'Home page full width content area. Appear just below of home page slider area.', 'eggnews-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	// end of the pro widget
	register_sidebar( array(
		'name'          => esc_html__( 'Home Page Main Content Area', 'eggnews-pro' ),
		'id'            => 'eggnews_home_content_area',
		'description'   => esc_html__( 'This sidebar will appear below of home page Full Width Above Main Content area. ', 'eggnews-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Home Page Sidebar', 'eggnews-pro' ),
		'id'            => 'eggnews_home_sidebar',
		'description'   => esc_html__( 'Home page sidebar of News Home Page Template.', 'eggnews-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );
// This is pro widget //
	register_sidebar( array(
		'name'          => esc_html__( 'Full Width Below Main Content', 'eggnews-pro' ),
		'id'            => 'eggnews_home_page_full_width_after_content_area',
		'description'   => esc_html__( 'Home page full width content area. Appear just below of home page main content area.', 'eggnews-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	// end of the pro widget
	register_sidebar( array(
		'name'          => esc_html__( 'Top Footer 1st Column', 'eggnews-pro' ),
		'id'            => 'eggnews_footer_one',
		'description'   => esc_html__( 'First column of top footer section. Appear only if at least one column footer widget area selected from customizer top footer settings.', 'eggnews-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Top Footer 2nd Column', 'eggnews-pro' ),
		'id'            => 'eggnews_footer_two',
		'description'   => esc_html__( 'Second column of top footer section. Appear only if at least two column footer widget area selected from customizer top footer settings.', 'eggnews-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Top Footer 3rd Column', 'eggnews-pro' ),
		'id'            => 'eggnews_footer_three',
		'description'   => esc_html__( 'Third column of top footer section. Appear only if at least three column footer widget area selected from customizer top footer settings.', 'eggnews-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Top Footer 4th Column', 'eggnews-pro' ),
		'id'            => 'eggnews_footer_four',
		'description'   => esc_html__( 'Fourth column of top footer section. Appear only if at least four column footer widget area selected from customizer top footer settings.', 'eggnews-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );
	require get_template_directory() . '/pro/eggnews-sidebar.php';


}

add_action( 'widgets_init', 'eggnews_widgets_init' );


/**
 * Load widgets files
 */
require get_template_directory() . '/inc/widgets/eggnews-widget-fields.php';
require get_template_directory() . '/inc/widgets/eggnews-featured-slider.php';
require get_template_directory() . '/inc/widgets/eggnews-post-carousel.php';
require get_template_directory() . '/inc/widgets/eggnews-block-grid.php';
require get_template_directory() . '/inc/widgets/eggnews-block-column.php';
require get_template_directory() . '/inc/widgets/eggnews-ads-banner.php';
require get_template_directory() . '/inc/widgets/eggnews-block-layout.php';
require get_template_directory() . '/inc/widgets/eggnews-posts-list.php';
require get_template_directory() . '/inc/widgets/eggnews-block-list.php';
require get_template_directory() . '/inc/widgets/eggnews-tab.php';
require get_template_directory() . '/inc/widgets/eggnews-random-news.php';
