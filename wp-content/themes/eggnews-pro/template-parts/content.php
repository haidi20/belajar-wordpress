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
	<?php if( has_post_thumbnail() ) { ?>
			<div class="post-image">
				<a href="<?php the_permalink();?>" title="<?php the_title();?>">
					<figure><?php the_post_thumbnail( 'eggnews-single-large' ); ?></figure>
				</a>
			</div>
	<?php } ?>

	<div class="archive-desc-wrapper clearfix">
		<header class="entry-header">
			<?php
			$show_hide_archive_category = get_theme_mod( 'show_hide_archive_category', 'show' );
			if ( $show_hide_archive_category != 'hide' ) { 
				do_action( 'eggnews_post_categories' ); 
			}
			?>
			<?php
				if ( is_single() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}
			?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<div class="entry-meta">
				<?php
				$show_hide_archive_date_author = get_theme_mod( 'show_hide_archive_date_author', 'show' );
				if ( $show_hide_archive_date_author == 'show' ) {
					echo eggnews_posted_on();
				} ?>
				<?php
				$show_hide_archive_comment = get_theme_mod( 'show_hide_archive_comment', 'show' );
				if ($show_hide_archive_comment == 'show' ) {
					echo eggnews_post_comment();
				} ?>
				<?php
				echo eggnews_archive_post_view_display( get_the_ID() );
				?> 
			</div><!-- .entry-meta -->
			<?php eggnews_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .archive-desc-wrapper -->
</article><!-- #post-## -->
