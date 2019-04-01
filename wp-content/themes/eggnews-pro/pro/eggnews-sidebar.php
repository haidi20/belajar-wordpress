<?php
/**
 * Pro sidebar area
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

register_sidebar( array(
	'name'          => esc_html__( '404 Page Sidebar', 'eggnews-pro' ),
	'id'            => 'eggnews_404_sidebar',
	'description'   => esc_html__( 'Shows on 404 page', 'eggnews-pro' ),
	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	'after_widget'  => '</section>',
	'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
	'after_title'   => '</h4></div>',
) );
register_sidebar( array(
	'name'          => esc_html__( 'Middle Footer 1st Column', 'eggnews-pro' ),
	'id'            => 'eggnews_middle_footer_one',
	'description'   => esc_html__( 'First column of middle footer section. Appear only if at least one column footer widget area selected from customizer middle footer settings.', 'eggnews-pro' ),
	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	'after_widget'  => '</section>',
	'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
	'after_title'   => '</h4></div>',
) );

register_sidebar( array(
	'name'          => esc_html__( 'Middle Footer 2nd Column', 'eggnews-pro' ),
	'id'            => 'eggnews_middle_footer_two',
	'description'   => esc_html__( 'Second column of middle footer section. Appear only if at least two column footer widget area selected from customizer middle footer settings.', 'eggnews-pro' ),
	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	'after_widget'  => '</section>',
	'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
	'after_title'   => '</h4></div>',
) );

register_sidebar( array(
	'name'          => esc_html__( 'Middle Footer 3rd Column', 'eggnews-pro' ),
	'id'            => 'eggnews_middle_footer_three',
	'description'   => esc_html__( 'Third column of middle footer section. Appear only if at least three column footer widget area selected from customizer middle footer settings.', 'eggnews-pro' ),
	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	'after_widget'  => '</section>',
	'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
	'after_title'   => '</h4></div>',
) );

register_sidebar( array(
	'name'          => esc_html__( 'Middle Footer 4th Column', 'eggnews-pro' ),
	'id'            => 'eggnews_middle_footer_four',
	'description'   => esc_html__( 'Fourth column of middle footer section. Appear only if at least four column footer widget area selected from customizer middle footer settings.', 'eggnews-pro' ),
	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	'after_widget'  => '</section>',
	'before_title'  => '<div class="widget-title-wrapper"><h4 class="widget-title">',
	'after_title'   => '</h4></div>',
) );
