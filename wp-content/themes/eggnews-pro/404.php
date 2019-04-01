<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

get_header(); ?>
	<div id="primary404" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'eggnews-pro' ); ?></h1>
				</header><!-- .page-header -->
				<div class="error-num"> <?php esc_html_e( '404', 'eggnews-pro' ); ?>
					<span><?php esc_html_e( 'error', 'eggnews-pro' ); ?></span></div>
				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'eggnews-pro' ); ?></p>
				</div><!-- .page-content -->
				<?php get_search_form(); ?>
				<?php if ( is_active_sidebar( 'eggnews_404_sidebar' ) ) {
					?>

					<?php do_action( 'eggnews_before_sidebar' ); ?>
					<?php dynamic_sidebar( 'eggnews_404_sidebar' ); ?>
					<?php do_action( 'eggnews_after_sidebar' ); ?>
					<?php
				} ?>
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
