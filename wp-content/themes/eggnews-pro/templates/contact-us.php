<?php
/**
 * Template Name: Contact US
 *
 * Displays the Contact Page Template of the theme.
 *
 * @package ThemeEgg
 * @subpackage EggNewsPro
 * @since EggNewsPro 1.0
 */

get_header(); ?>

<?php do_action( 'eggnews_before_body_content' ); ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php
            while ( have_posts() ) : the_post();

                get_template_part( 'template-parts/content', 'page' );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
eggnews_sidebar();
do_action( 'eggnews_after_body_content' );
get_footer();