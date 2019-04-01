<?php
/**
 * Template part for displaying posts.
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
	$show_hide_feature_image = get_theme_mod( 'eggnews_show_hide_feature_on_singe_post', 'show' );

	if ( has_post_thumbnail() && $show_hide_feature_image === 'show' ) { ?>
		<div class="single-post-image">
			<figure><?php the_post_thumbnail( 'eggnews-single-large' ); ?></figure>
		</div><!-- .single-post-image -->
	<?php } ?>
	<header class="entry-header">
		<?php
		$show_hide_post_category = get_theme_mod( 'eggnews_category_option', 'show' );
		if ( $show_hide_post_category != 'hide' ) { 
			do_action( 'eggnews_post_categories' ); 
		}
		?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-meta">
				<?php
				$show_hide_single_post_date_author = get_theme_mod( 'eggnews_date_author_option', 'show' );
				if ( $show_hide_single_post_date_author == 'show' ) {
					echo eggnews_posted_on();
				} ?>
				<?php
				$show_hide_single_post_comment = get_theme_mod( 'eggnews_comment_count_option', 'show' );
				if ( $show_hide_single_post_comment == 'show' ) {
					echo eggnews_post_comment();
				} ?>
				<?php
				echo eggnews_post_view_display( get_the_ID() );
				?>
 		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content( sprintf(
		/* translators: %s: Name of current post. */
			wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'eggnews-pro' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		) );


		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'eggnews-pro' ),
			'after'  => '</div>',
		) );
		?>
		<?php
		$social_sharing_single_post = get_theme_mod( 'eggnews_social_sharing_option', 'show' );
		if ( $social_sharing_single_post === 'show' ) {
			echo eggnews_get_social_sharing_bottom();
		} ?>

	</div><!-- .entry-content -->
	<?php eggnews_post_view_setup( get_the_ID() ); ?>
	<footer class="entry-footer">
		<?php eggnews_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
