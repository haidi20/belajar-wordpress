<?php

/**
 * Eggnews functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */
if (!function_exists('eggnews_sass_darken')) :

    function eggnews_sass_darken($hex, $percent) {
        if (!$hex) {
            return;
        }
        preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors);
        str_replace('%', '', $percent);
        $color = "#";
        for ($i = 1; $i <= 3; $i ++) {
            $rgb = hexdec($primary_colors[$i]);
            $calculated_color = round((int) $rgb * ( 100 - ( (int) $percent * 2 ) ) / 100);
            $calculated_color = $calculated_color < 0 ? 0 : $calculated_color;
            $color .= str_pad(dechex($calculated_color), 2, '0', STR_PAD_LEFT);
        }

        return $color;
    }

endif;
if (!function_exists('eggnews_sass_lighten')) :

    function eggnews_sass_lighten($hex, $percent) {
        if (!$hex) {
            return;
        }
        preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors);
        str_replace('%', '', $percent);
        $color = "#";
        for ($i = 1; $i <= 3; $i ++) {
            $rgb = hexdec($primary_colors[$i]);
            $calculated_color = round((int) $rgb * ( 100 + (int) $percent ) / 100);
            $calculated_color = $calculated_color > 254 ? 255 : $calculated_color;
            $color .= str_pad(dechex($calculated_color), 2, '0', STR_PAD_LEFT);
        }

        return $color;
    }

endif;

function eggnews_get_words($sentence, $count = 20) {
    preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
    return $matches[0];
}

/**
 * Retrieves the post excerpt.
 *
 * @since 1.2.0
 *
 * @param Excerpt length Optional. Default is 20.
 * @return string Post excerpt.
 */
function eggnews_get_excerpt( $length = 20) {

    global $post;

    if ( empty( $post ) ) {
        return '';
    }

    if ( post_password_required( $post ) ) {
        return esc_html__( 'There is no excerpt because this is a protected post.' );
    }

    $get_the_content = get_the_content();

    $content_filters = strip_shortcodes( $get_the_content );

    $excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );

    $trim_content = wp_trim_words( $content_filters, $length, $excerpt_more );

    $post_excerpt = apply_filters( 'wp_trim_excerpt', $trim_content );

    /**
     * Filters the retrieved post excerpt.
     *
     *
     * @param string $post_excerpt The post excerpt.
     * @param WP_Post $post Post object.
     */
    return apply_filters( 'get_the_excerpt', $post_excerpt, $post );
}

function eggnews_excerpt($length = 20) {
    
    $get_the_excerpt =  eggnews_get_excerpt($length);

     echo apply_filters( 'the_excerpt', $get_the_excerpt );

}

if (!function_exists('eggnews_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function eggnews_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Eggnews, use a find and replace
         * to change 'eggnews-pro' to the name of your theme in all the template files.
         */
        load_theme_textdomain('eggnews-pro', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for custom logo.
         */
        add_theme_support('custom-logo', array(
            'height' => 175,
            'width' => 400,
            'flex-width' => true,
            'flex-height' => true
        ));

        add_image_size('eggnews-slider-large', 1020, 731, true);
        add_image_size('eggnews-pro-featured-post-small', 1024, 768, true);
        add_image_size('eggnews-featured-medium', 420, 307, true);
        add_image_size('eggnews-featured-long', 300, 443, true);
        add_image_size('eggnews-footer-readmore-thumbnail', 218, 150, true);
        add_image_size('eggnews-pro-tab-thumbnail', 136, 102, true);
        add_image_size('eggnews-block-medium', 464, 290, true);
        add_image_size('eggnews-carousel-image', 600, 500, true);
        add_image_size('eggnews-block-thumb', 322, 230, true);
        add_image_size('eggnews-single-large', 1210, 642, true);

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'eggnews-pro'),
            'top-header' => esc_html__('Top Header Menu', 'eggnews-pro'),
            'footer' => esc_html__('Footer Menu', 'eggnews-pro'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('eggnews_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, and column width.
         */
        add_editor_style(get_template_directory_uri() . '/assets/css/editor-style.css');
    }

endif;
add_action('after_setup_theme', 'eggnews_setup');

/**
 * Define Directory Location Constants
 */
define('EGGNEWS_PARENT_DIR', get_template_directory());
define('EGGNEWS_CHILD_DIR', get_stylesheet_directory());

define('EGGNEWS_INCLUDES_DIR', EGGNEWS_PARENT_DIR . '/inc');
define('EGGNEWS_CSS_DIR', EGGNEWS_PARENT_DIR . '/css');
define('EGGNEWS_JS_DIR', EGGNEWS_PARENT_DIR . '/js');
define('EGGNEWS_LANGUAGES_DIR', EGGNEWS_PARENT_DIR . '/languages');

define('EGGNEWS_ADMIN_DIR', EGGNEWS_INCLUDES_DIR . '/admin');
define('EGGNEWS_WIDGETS_DIR', EGGNEWS_INCLUDES_DIR . '/widgets');

define('EGGNEWS_ADMIN_IMAGES_DIR', EGGNEWS_ADMIN_DIR . '/images');

/**
 * Define URL Location Constants
 */
define('EGGNEWS_PARENT_URL', get_template_directory_uri());
define('EGGNEWS_CHILD_URL', get_stylesheet_directory_uri());

define('EGGNEWS_INCLUDES_URL', EGGNEWS_PARENT_URL . '/inc');
define('EGGNEWS_CSS_URL', EGGNEWS_PARENT_URL . '/css');
define('EGGNEWS_JS_URL', EGGNEWS_PARENT_URL . '/js');
define('EGGNEWS_LANGUAGES_URL', EGGNEWS_PARENT_URL . '/languages');

define('EGGNEWS_ADMIN_URL', EGGNEWS_INCLUDES_URL . '/admin');
define('EGGNEWS_WIDGETS_URL', EGGNEWS_INCLUDES_URL . '/widgets');

define('EGGNEWS_ADMIN_IMAGES_URL', EGGNEWS_ADMIN_URL . '/images');
define('EGGNEWS_THEME_PATH_SETUP', EGGNEWS_INCLUDES_DIR . '/setup/');

define('EGGNEWS_THEME_NAME', 'EggNewsPro');
define('EGGNEWS_THEME_FOLDER', 'eggnews-pro');
define('EGGNEWS_THEME_VER', '1.3.1');

/**
 * define theme version variable
 * @since 1.1.3
 */
function eggnews_theme_version() {
    $eggnews_theme_info = wp_get_theme();
    $GLOBALS['eggnews_version'] = $eggnews_theme_info->get('Version');
}

add_action('after_setup_theme', 'eggnews_theme_version', 0);

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function eggnews_content_width() {
    $GLOBALS['content_width'] = apply_filters('eggnews_content_width', 640);
}

add_action('after_setup_theme', 'eggnews_content_width', 0);

/* Implement pro feature */

require_once( get_template_directory() . '/pro/functions.php' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Eggnews custom functions
 */
require get_template_directory() . '/inc/eggnews-functions.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load widgets areas
 */
require get_template_directory() . '/inc/widgets/eggnews-widgets-area.php';

/**
 * Load metabox
 */
require get_template_directory() . '/inc/admin/metaboxes/eggnews-post-metabox.php';

/**
 * Load customizer custom classes
 */
require get_template_directory() . '/inc/admin/eggnews-custom-classes.php'; //custom classes

/**
 * Load customizer sanitize
 */
require get_template_directory() . '/inc/admin/eggnews-sanitize.php'; //custom classes


/* Calling in the admin area for the Welcome Page */
if ( is_admin() ) {
    require get_template_directory() . '/inc/admin/class-eggnews-admin.php';
}

/**
 * Load TGMPA Configs.
 */
require_once( EGGNEWS_INCLUDES_DIR . '/tgm-plugin-activation/class-tgm-plugin-activation.php' );

require_once( EGGNEWS_INCLUDES_DIR . '/tgm-plugin-activation/tgmpa-eggnews.php' );

require_once( get_template_directory() . '/pro/shortcode/class-eggnews-pro-shortcode-googlemap.php' );
if (!class_exists('Eggnews_Pro_Widgets')) {
    require_once( get_template_directory() . '/pro/widgets/class-wp-eggnews-pro-widgets.php' );
}

function eggnews_theme_updater() {
    require( get_template_directory() . '/updater/theme-updater.php' );
}

add_action('after_setup_theme', 'eggnews_theme_updater');

// Function to remove version numbers
function themeegg_remove_versioning($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }

    return $src;
}

add_action('after_setup_theme', 'woocommerce_support');

function woocommerce_support() {
    add_theme_support('woocommerce');
}

/* Remove Responsive Image */

function eggnews_pro_srcset($sources) {
    return false;
}

add_filter('wp_calculate_image_srcset', 'eggnews_pro_srcset');
add_filter('wp_get_attachment_image_attributes', 'bea_remove_srcset', PHP_INT_MAX, 1);

function bea_remove_srcset($attr) {
    if (class_exists('BEA_Images')) {
        return $attr;
    }
    if (isset($attr['sizes'])) {
        unset($attr['sizes']);
    }
    if (isset($attr['srcset'])) {
        unset($attr['srcset']);
    }

    return $attr;
}

// Override the calculated image sizes
add_filter('wp_calculate_image_sizes', '__return_false', PHP_INT_MAX);
// Override the calculated image sources
add_filter('wp_calculate_image_srcset', '__return_false', PHP_INT_MAX);
// Remove the reponsive stuff from the content
remove_filter('the_content', 'wp_make_content_images_responsive');


/**                 
  * Load More Feature                 
  * @package Theme Egg                 
  * @subpackage eggnews-pro                 
  * @since 1.2.0 
 **/

function eggnews_pro_my_load_more_scripts() {
    global $wp_query;
    wp_enqueue_script('jquery');
    wp_localize_script( 'jquery', 'eggnewspro_loadmore_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
        'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
        // 'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
        // 'max_page' => $wp_query->max_num_pages
    ) );
    wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'eggnews_pro_my_load_more_scripts' );

function eggnews_pro_post_lising_loadmore(){

    $page = isset($_POST['paged']) ? esc_attr($_POST['paged']) : 2;
    $posts_per_page = isset($_POST['posts_per_page']) ? esc_attr($_POST['posts_per_page']) :'';
    $post__not_in = isset($_POST['post__not_in']) ? $_POST['post__not_in'] : array();
    $posts_type = isset($_POST['posts_type']) ? esc_attr($_POST['posts_type']) : '';
    $hide_post_date = isset($_POST['hide_post_date']) ? esc_attr($_POST['hide_post_date']) : '';
    $hide_author = isset($_POST['hide_author']) ? esc_attr($_POST['hide_author']) : '';
    $excerpt = isset($_POST['excerpt']) ? esc_attr($_POST['excerpt']) : ''; 
    $excerpt_length = isset($_POST['excerpt_length']) ? esc_attr($_POST['excerpt_length']) : '';
    $classs = isset($_POST['classs']) ? esc_attr($_POST['classs']) : '';

    $posts_list_args = eggnews_query_args($cat_id = null, $posts_per_page);
    if ($posts_type == 'random') {
        $posts_list_args['orderby'] = 'rand';
        $posts_list_args['post__not_in'] = $post__not_in;
    }else{
        $posts_list_args['paged'] = $page;
    }
    wp_reset_postdata();
    $posts_list_query = new WP_Query($posts_list_args);
    if ($posts_list_query->have_posts()) {
        while ($posts_list_query->have_posts()){
            $posts_list_query->the_post();

            ?>

            <div class="single-post-wrapper clearfix" data-id="<?php echo get_the_ID(); ?>">
                <div class="post-thumb-wrapper">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <figure><?php the_post_thumbnail('eggnews-block-thumb'); ?></figure>
                    </a>
                </div>
                <div class="post-content-wrapper">
                    <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="post-meta-wrapper">
                        <?php eggnews_posted_on($hide_post_date, $hide_author); ?>
                    </div><!-- .post-meta-wrapper -->
                    <?php if ($excerpt): ?>

                        <div class="post-excerpt">
                            <?php eggnews_excerpt($excerpt_length); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div><!-- .single-post-wrapper -->
            <?php
        }
    }
    die; 
}
add_action('wp_ajax_post_listing_loadmore', 'eggnews_pro_post_lising_loadmore'); 
add_action('wp_ajax_nopriv_post_listing_loadmore', 'eggnews_pro_post_lising_loadmore');


