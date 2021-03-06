<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$show_hide_feature_image = get_theme_mod( 'eggnews_show_hide_feature_on_singe_page', 'show' );

	if ( has_post_thumbnail() && $show_hide_feature_image === 'show' ) { ?>
		<div class="post-image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<figure><?php the_post_thumbnail( 'eggnews-single-large' ); ?></figure>
			</a>
		</div>
	<?php } ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'eggnews-pro' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'eggnews-pro' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
