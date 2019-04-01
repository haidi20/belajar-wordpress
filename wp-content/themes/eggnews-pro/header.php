<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php do_action( 'eggnews_before_page' );
	$value = get_theme_mod('eggnews_home_icon_option');
	?>
	<?php $preload_section = get_theme_mod('eggnews_preloader_section_option', ''); 
	$eggnews_section_color = get_theme_mod('eggnews_section_color');
	$eggnews_preloader_bg = isset($eggnews_section_color['preload_background_color']) ? esc_attr($eggnews_section_color['preload_background_color']) : '';
	if(!empty($preload_section)) {

		 /**                 
			* Preload Feature                 
			* @package Theme Egg                 
			* @subpackage eggnews-pro                 
			* @since 1.2.0   
		  */?>
		  <div class="preloader" style="background-color: <?php echo $eggnews_preloader_bg; ?>">
		  	<div class="preloader-gif">
		  		<img src="<?php echo esc_url($preload_section); ?>" >
		  	</div>
		  </div>
		<?php } ?> 
	<div id="page" class="site">
		<?php do_action( 'eggnews_before_header' ); ?>
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'eggnews-pro' ); ?></a>
		<?php
		$header_style = get_theme_mod( 'eggnews_header_style_option', 'style-1' );
		get_template_part('template-parts/header/header', $header_style);
		do_action( 'eggnews_after_header' );
		do_action( 'eggnews_before_main' );
		?>
		<div id="content" class="site-content">
			<div class="teg-container">
