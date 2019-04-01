<?php
/**
 * Breadcrumbs.
 *
 * @package EggNews Pro
 */

//Bail if front page .
if ( is_front_page() || is_page_template( 'templates/home.php' ) ) {
	return;
}

$breadcrumb_type = get_theme_mod( 'eggnews_enable_breadcrumb', 'yes' );
if ( 'yes' !== $breadcrumb_type ) {
	return;
}
if ( ! function_exists( 'eggnews_breadcrumb_trail' ) ) {
	require_once trailingslashit( get_template_directory() ) . '/inc/vendor/breadcrumbs/breadcrumbs.php';
}

$breadcrumb_layout = get_theme_mod('eggnews_breadcrumb_layout', 'layout1');
?>

<div id="breadcrumb" class="<?php echo $breadcrumb_layout; ?>">
	<div class="teg-container">
		<?php
		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
		);
		eggnews_breadcrumb_trail( $breadcrumb_args );
		?>
	</div><!-- .container -->
</div><!-- #breadcrumb -->
