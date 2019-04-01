<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */
$is_feature_slider = (int) get_theme_mod('eggnews_categories_slider', 0);
$queried_object = $wp_query->get_queried_object();
$show_on = ( isset($queried_object->cat_ID) ) ? true : false;
get_header();
?>
    <div class="featured-slider-section">
        <?php
        if ($is_feature_slider && $show_on) {
            add_filter('eggnews_featured_different_posts', '__return_true');
            $cat_id = $queried_object->cat_ID;
            ?>
            <header class="page-header teg-cat-<?php echo esc_attr($cat_id); ?>">
                <h1 class="page-title teg-archive-title"><?php the_archive_title(); ?></h1>
            </header><!-- .page-header -->
            <?php
            the_archive_description('<div class="taxonomy-description">', '</div>');
            $widget = 'Eggnews_Featured_Slider';
            $instance = array(
                'eggnews_slider_category' => $cat_id,
                'eggnews_slide_count' => 1,
                'featured_header_section' => '',
                'eggnews_featured_category' => $cat_id,
                'eggnews_hide_category' => 1,
                'eggnews_slider_layout' => 'left',
            );

            the_widget($widget, $instance);
        }
        ?>
    </div>
</div> <!-- end of teg-container start on header -->
<div class="teg-container"> <!-- start teg-container close on footer -->
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
            $teg_cat_id = get_query_var('cat');
            if (have_posts()) :
                if (!($is_feature_slider && $show_on)) {
                    ?>
                    <header class="page-header teg-cat-<?php echo esc_attr($teg_cat_id); ?>">
                        <h1 class="page-title teg-archive-title"><?php the_archive_title(); ?></h1>
                    </header><!-- .page-header -->
                    <?php
                    the_archive_description('<div class="taxonomy-description">', '</div>');
                }
                ?>
                <div class="archive-content-wrapper clearfix">
                    <?php
                    /* Start the Loop */
                    while (have_posts()) : the_post();
                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part('template-parts/content', get_post_format());

                    endwhile;

                    the_posts_pagination();
                    ?>
                </div><!-- .archive-content-wrapper -->
                <?php
            else :

                get_template_part('template-parts/content', 'none');

            endif;
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
eggnews_sidebar();
get_footer();
