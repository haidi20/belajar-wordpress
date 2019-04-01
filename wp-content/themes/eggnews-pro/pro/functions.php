<?php
/**
 * Pro  functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */
/*
 * Random Post in header
 */
require_once( get_template_directory() . '/pro/google-fonts.php' );

if ( ! function_exists( 'eggnews_random_post' ) ) :

	function eggnews_random_post() {

		if ( get_theme_mod( 'eggnews_random_post_option', 'enable' ) !== 'enable' ) {

			return '';
		}
		$get_random_post = new WP_Query( array(
			'posts_per_page'      => 1,
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
			'orderby'             => 'rand'
		) );
		?>
		<div class="random-post">
			<?php while ( $get_random_post->have_posts() ):$get_random_post->the_post(); ?>
				<a href="<?php the_permalink(); ?>" title="<?php _e( 'View a random post', 'eggnews-pro' ); ?>"><i
						class="<?php echo esc_attr(eggnews_get_icon('eggnews_random_icon_option', 'fa fa-random' ))?>"></i></a>
			<?php endwhile; ?>
		</div>
		<?php
		// Reset Post Data
		wp_reset_query();
	}

endif;


/* * ************************************************************************************* */

if ( ! function_exists( 'eggnews_font_size_range_generator' ) ) :

	function eggnews_font_size_range_generator( $start_range, $end_range ) {
		$range_string = array();
		for ( $i = $start_range; $i <= $end_range; $i ++ ) {
			$range_string[ $i ] = $i;
		}

		return $range_string;
	}

endif;
/* * ************************************************************************************* */

if ( ! function_exists( 'eggnews_dynamic_css' ) ) :

	function eggnews_dynamic_css( $css ) {
		// google fonts custom css
		if ( get_theme_mod( 'eggnews_site_title_font', 'Merriweather' ) != 'Merriweather' ) {

			$css .= ' #site-title a { font-family: "' . get_theme_mod( 'eggnews_site_title_font', 'Merriweather' ) . '"; }';
		}
		if ( get_theme_mod( 'eggnews_site_description_font', 'Merriweather' ) != 'Merriweather' ) {

			$css .= ' .site-title-wrapper .site-description { font-family: "' . get_theme_mod( 'eggnews_site_description_font', 'Merriweather' ) . '"; }';
		}
		if ( get_theme_mod( 'eggnews_primary_menu_font', 'Merriweather' ) != 'Merriweather' ) {

			$css .= '.main-navigation.main-navigation ul li a { font-family: "' . get_theme_mod( 'eggnews_primary_menu_font', 'Merriweather' ) . '"; }';
		}
		if ( get_theme_mod( 'eggnews_all_titles_font', 'Merriweather' ) != 'Merriweather' ) {

			$css .= ' h1,h2,h3,h4,h5,h6 { font-family: "' . get_theme_mod( 'eggnews_all_titles_font', 'Merriweather' ) . '"; }';
		}
		if ( get_theme_mod( 'eggnews_content_font', 'Merriweather' ) != 'Merriweather' ) {

			$css .= ' body, button, input, select, textarea, p, blockquote p, .entry-meta, .more-link, .entry-date , .published, .updated { font-family: "' . get_theme_mod( 'eggnews_content_font', 'Merriweather' ) . '"; }';
		}
		if ( get_theme_mod( 'eggnews_title_font_size', '32' ) != '32' ) {

			$css .= ' #site-title a { font-size: ' . get_theme_mod( 'eggnews_title_font_size', '32' ) . 'px; }';
		}
		if ( get_theme_mod( 'eggnews_description_font_size', '14' ) != '14' ) {

			$css .= ' .site-title-wrapper .site-description { font-size: ' . get_theme_mod( 'eggnews_description_font_size', '14' ) . 'px; }';
		}
		if ( get_theme_mod( 'eggnews_primary_menu_font_size', '14' ) != '14' ) {

			$css .= ' .main-navigation.main-navigation ul.parent-list>li>a { font-size: ' . get_theme_mod( 'eggnews_primary_menu_font_size', '14' ) . 'px; }';
		}
		if ( get_theme_mod( 'eggnews_primary_sub_menu_font_size', '14' ) != '14' ) {

			$css .= ' .main-navigation.main-navigation ul.sub-menu a { font-size: ' . get_theme_mod( 'eggnews_primary_sub_menu_font_size', '14' ) . 'px; }';
		}
		if ( get_theme_mod( 'eggnews_heading_h1_font_size', '36' ) != '36' ) {


			$css .= ' body h1 { font-size: ' . get_theme_mod( 'eggnews_heading_h1_font_size', '36' ) . 'px; }';
		}
		if ( get_theme_mod( 'eggnews_heading_h2_font_size', '30' ) != '30' ) {

			$css .= ' body h2 { font-size: ' . get_theme_mod( 'eggnews_heading_h2_font_size', '30' ) . 'px; }';
		}
		if ( get_theme_mod( 'eggnews_heading_h3_font_size', '26' ) != '26' ) {

			$css .= ' body h3 { font-size: ' . get_theme_mod( 'eggnews_heading_h3_font_size', '26' ) . 'px; }';
		}
		if ( get_theme_mod( 'eggnews_heading_h4_font_size', '20' ) != '20' ) {

			$css .= ' body h4 { font-size: ' . get_theme_mod( 'eggnews_heading_h4_font_size', '20' ) . 'px; }';
		}
		if ( get_theme_mod( 'eggnews_heading_h5_font_size', '18' ) != '18' ) {

			$css .= ' body h5 { font-size: ' . get_theme_mod( 'eggnews_heading_h5_font_size', '18' ) . 'px; }';
		}
		if ( get_theme_mod( 'eggnews_heading_h6_font_size', '16' ) != '16' ) {

			$css .= ' body h6 { font-size: ' . get_theme_mod( 'eggnews_heading_h6_font_size', '16' ) . 'px; }';
		}
		if ( get_theme_mod( 'eggnews_post_title_font_size', '28' ) != '28' ) {

			$css .= ' body article.post.type-post .entry-title { font-size: ' . get_theme_mod( 'eggnews_post_title_font_size', '28' ) . 'px; }';
		}
		if ( get_theme_mod( 'eggnews_page_title_font_size', '28' ) != '28' ) {

			$css .= ' body article.page.type-page .entry-title { font-size: ' . get_theme_mod( 'eggnews_page_title_font_size', '28' ) . 'px; }';
		}

		if ( get_theme_mod( 'eggnews_widget_title_font_size', '18' ) != '18' ) {

			$css .= ' .block-header .block-title, .widget .widget-title, .related-articles-wrapper .related-title { font-size: ' . get_theme_mod( 'eggnews_widget_title_font_size', '18' ) . 'px; }';
		}
		if ( get_theme_mod( 'eggnews_comment_title_font_size', '22' ) != '22' ) {

			$css .= ' #comments h2.comments-title { font-size: ' . get_theme_mod( 'eggnews_comment_title_font_size', '22' ) . 'px; }';
		}
		if ( get_theme_mod( 'eggnews_footer_widget_content_font_size', '14' ) != '14' ) {

			$css .= 'footer th, footer td, #colophon #top-footer a, footer#colophon #top-footer span, footer#colophon #top-footer p, ';
			$css .= 'footer#colophon #middle-footer a, footer#colophon #middle-footer span, footer#colophon #middle-footer p, ';
			$css .= 'footer#colophon #bottom-footer a, footer#colophon #bottom-footer span, footer#colophon #bottom-footer p  { font-size: ' . get_theme_mod( 'eggnews_footer_widget_content_font_size', '14' ) . 'px; }';
		}
		if ( get_theme_mod( 'eggnews_footer_widget_title_font_size', '18' ) != '18' ) {

			$css .= 'footer .block-header .block-title, footer .widget .widget-title, footer .related-articles-wrapper .related-title  { font-size: ' . get_theme_mod( 'eggnews_footer_widget_title_font_size', '18' ) . 'px; }';
		}
		if ( get_theme_mod( 'eggnews_footer_copyright_text_font_size', '14' ) != '14' ) {

			$css .= ' footer#colophon .teg-container #site-info span.copy-info,  footer#colophon .teg-container #site-info, footer#colophon .teg-container #site-info a, footer#colophon .teg-container #site-info a, footer#colophon .copyright { font-size: ' . get_theme_mod( 'eggnews_footer_copyright_text_font_size', '14' ) . 'px }';
		}

		$eggnews_website_image_hover_option = get_theme_mod( 'eggnews_website_image_hover_option', 'default' );

		switch ( $eggnews_website_image_hover_option ) {

			case 'no_hover_effect':
				$css .= ' .single-featured-wrap figure img:hover, .eggnews-carousel .owl-item figure img:hover, .eggnewsSlider li figure img:hover, .eggnewsCarousel li figure img:hover, .post-thumb-wrapper figure img:hover, .single-post-wrapper figure img:hover{transform: none;-webkit-transform: none;-moz-transform: none;-o-transform: none;}';
				break;
			case 'circle_out_effect':
				$css .= ' .single-featured-wrap figure img:hover, .eggnews-carousel .owl-item figure img:hover, .eggnewsSlider li figure img:hover, .eggnewsCarousel li figure img:hover, .post-thumb-wrapper figure img:hover, .single-post-wrapper figure img:hover{transform: none;-webkit-transform: none;-moz-transform: none;-o-transform: none;}';
				$css .= ' .single-featured-wrap figure:before, .eggnews-carousel .owl-item figure:before, .eggnewsSlider li figure:before, .eggnewsCarousel li figure:before, .post-thumb-wrapper figure:before, .single-post-wrapper figure:before{';
				$css .= 'position: absolute;top: 50%;left:50%;z-index: 2;display: block;content: \'\';width: 0;height: 0;background: rgba(255,255,255,.2);border-radius: 100%;-webkit-transform: translate(-50%,-50%);-ms-transform: translate(-50%,-50%);transform: translate(-50%,-50%);opacity: 0;}';

				$css .= ' .single-featured-wrap figure:hover:before, .eggnews-carousel .owl-item figure:hover:before, .eggnewsSlider li figure:hover:before, .eggnewsCarousel li figure:hover:before, .post-thumb-wrapper figure:hover:before, .single-post-wrapper figure:hover:before{';
				$css .= '-webkit-animation: circle .75s;animation: circle .75s;}';
				break;

			default:
		}
		return $css;
	}
endif;

add_action( 'init', 'eggnews_add_shortcodes' );

function eggnews_add_shortcodes() {
	add_shortcode( 'the-year', 'eggnews_the_year_shortcode' );
	add_shortcode( 'site-url', 'eggnews_site_link_shortcode' );
	add_shortcode( 'wp-url', 'eggnews_wp_link_shortcode' );
	add_shortcode( 'teg-url', 'eggnews_eggnews_link_shortcode' );
}

function eggnews_the_year_shortcode() {
	return date( 'Y' );
}

function eggnews_site_link_shortcode() {
	return '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';
}

function eggnews_wp_link_shortcode() {
	return '<a href="' . esc_url( 'https://wordpress.org' ) . '" target="_blank" title="' . esc_attr__( 'WordPress', 'eggnews-pro' ) . '"><span>' . __( 'WordPress', 'eggnews-pro' ) . '</span></a>';
}

function eggnews_eggnews_link_shortcode() {
	return '<a href="' . esc_url( 'https://themeegg.com/themes/' ) . '" target="_blank" title="' . esc_attr__( 'ThemeEgg', 'eggnews-pro' ) . '" ><span>' . __( 'ThemeEgg', 'eggnews-pro' ) . '</span></a>';
}

add_action( 'eggnews_footer_copyright', 'eggnews_footer_copyright', 10 );

if ( ! function_exists( 'eggnews_footer_copyright' ) ) :

	function eggnews_footer_copyright() {
		$default_footer_value     = get_theme_mod( 'eggnews_copyright_text', __( 'Copyright &copy; ', 'eggnews-pro' ) . '[the-year] [site-url]. All rights reserved. ' . '<br>' . __( 'Theme: EggNews Pro by ', 'eggnews-pro' ) . '[teg-url]. ' . __( 'Powered by ', 'eggnews-pro' ) . '[wp-url].' );
		$eggnews_footer_copyright = '<div class="copyright">' . $default_footer_value . '</div>';
		echo do_shortcode( $eggnews_footer_copyright );

			
	}
    function eggnews_get_icon($option_key, $default){
        $icon = get_theme_mod($option_key, $default);
        if(empty($icon)){
            return $default;
        }
        return $icon;
    }
endif;



/**
 * Define font awesome icons for home / search /random and nav icons
 *
 * @return array();
 * @since 1.3.0
 */
if (!function_exists('eggnews_font_awesome_icons')) :

    function eggnews_font_awesome_icons() {
        $font_awesome = array(
            "fa fa-glass",
            "fa fa-music",
            "fa fa-search",
            "fa fa-envelope-o",
            "fa fa-heart",
            "fa fa-star",
            "fa fa-star-o",
            "fa fa-user",
            "fa fa-film",
            "fa fa-th-large",
            "fa fa-th",
            "fa fa-th-list",
            "fa fa-check",
            "fa fa-remove",
            "fa fa-close",
            "fa fa-times",
            "fa fa-search-plus",
            "fa fa-search-minus",
            "fa fa-power-off",
            "fa fa-signal",
            "fa fa fa-gear",
            "fa fa-cog",
            "fa fa-trash-o",
            "fa fa-home",
            "fa fa-file-o",
            "fa fa-clock-o",
            "fa fa-road",
            "fa fa-download",
            "fa fa-arrow-circle-o-down",
            "fa fa-arrow-circle-o-up",
            "fa fa-inbox",
            "fa fa-play-circle-o",
            "fa fa fa-rotate-right",
            "fa fa-repeat",
            "fa fa-refresh",
            "fa fa-list-alt",
            "fa fa-lock",
            "fa fa-flag",
            "fa fa-headphones",
            "fa fa-volume-off",
            "fa fa-volume-down",
            "fa fa-volume-up",
            "fa fa-qrcode",
            "fa fa-barcode",
            "fa fa-tag",
            "fa fa-tags",
            "fa fa-book",
            "fa fa-bookmark",
            "fa fa-print",
            "fa fa-camera",
            "fa fa-font",
            "fa fa-bold",
            "fa fa-italic",
            "fa fa-text-height",
            "fa fa-text-width",
            "fa fa-align-left",
            "fa fa-align-center",
            "fa fa-align-right",
            "fa fa-align-justify",
            "fa fa-list",
            "fa fa-dedent",
            "fa fa-outdent",
            "fa fa-indent",
            "fa fa-video-camera",
            "fa fa-photo",
            "fa fa-image",
            "fa fa-picture-o",
            "fa fa-pencil",
            "fa fa-map-marker",
            "fa fa-adjust",
            "fa fa-tint",
            "fa fa-edit",
            "fa fa-pencil-square-o",
            "fa fa-share-square-o",
            "fa fa-check-square-o",
            "fa fa-arrows",
            "fa fa-step-backward",
            "fa fa-fast-backward",
            "fa fa-backward",
            "fa fa-play",
            "fa fa-pause",
            "fa fa-stop",
            "fa fa-forward",
            "fa fa-fast-forward",
            "fa fa-step-forward",
            "fa fa-eject",
            "fa fa-chevron-left",
            "fa fa-chevron-right",
            "fa fa-plus-circle",
            "fa fa-minus-circle",
            "fa fa-times-circle",
            "fa fa-check-circle",
            "fa fa-question-circle",
            "fa fa-info-circle",
            "fa fa-crosshairs",
            "fa fa-times-circle-o",
            "fa fa-check-circle-o",
            "fa fa-ban",
            "fa fa-arrow-left",
            "fa fa-arrow-right",
            "fa fa-arrow-up",
            "fa fa-arrow-down",
            "fa fa-mail-forward",
            "fa fa-share",
            "fa fa-expand",
            "fa fa-compress",
            "fa fa-plus",
            "fa fa-minus",
            "fa fa-asterisk",
            "fa fa-exclamation-circle",
            "fa fa-gift",
            "fa fa-leaf",
            "fa fa-fire",
            "fa fa-eye",
            "fa fa-eye-slash",
            "fa fa-warning",
            "fa fa-exclamation-triangle",
            "fa fa-plane",
            "fa fa-calendar",
            "fa fa-random",
            "fa fa-comment",
            "fa fa-magnet",
            "fa fa-chevron-up",
            "fa fa-chevron-down",
            "fa fa-retweet",
            "fa fa-shopping-cart",
            "fa fa-folder",
            "fa fa-folder-open",
            "fa fa-arrows-v",
            "fa fa-arrows-h",
            "fa fa-bar-chart-o",
            "fa fa-bar-chart",
            "fa fa-twitter-square",
            "fa fa-facebook-square",
            "fa fa-camera-retro",
            "fa fa-key",
            "fa fa-gears",
            "fa fa-cogs",
            "fa fa-comments",
            "fa fa-thumbs-o-up",
            "fa fa-thumbs-o-down",
            "fa fa-star-half",
            "fa fa-heart-o",
            "fa fa-sign-out",
            "fa fa-linkedin-square",
            "fa fa-thumb-tack",
            "fa fa-external-link",
            "fa fa-sign-in",
            "fa fa-trophy",
            "fa fa-github-square",
            "fa fa-upload",
            "fa fa-lemon-o",
            "fa fa-phone",
            "fa fa-square-o",
            "fa fa-bookmark-o",
            "fa fa-phone-square",
            "fa fa-twitter",
            "fa fa-facebook-f",
            "fa fa-facebook",
            "fa fa-github",
            "fa fa-unlock",
            "fa fa-credit-card",
            "fa fa-feed",
            "fa fa-rss",
            "fa fa-hdd-o",
            "fa fa-bullhorn",
            "fa fa-bell",
            "fa fa-certificate",
            "fa fa-hand-o-right",
            "fa fa-hand-o-left",
            "fa fa-hand-o-up",
            "fa fa-hand-o-down",
            "fa fa-arrow-circle-left",
            "fa fa-arrow-circle-right",
            "fa fa-arrow-circle-up",
            "fa fa-arrow-circle-down",
            "fa fa-globe",
            "fa fa-wrench",
            "fa fa-tasks",
            "fa fa-filter",
            "fa fa-briefcase",
            "fa fa-arrows-alt",
            "fa fa-group",
            "fa fa-users",
            "fa fa-chain",
            "fa fa-link",
            "fa fa-cloud",
            "fa fa-flask",
            "fa fa-cut",
            "fa fa-scissors",
            "fa fa-copy",
            "fa fa-files-o",
            "fa fa-paperclip",
            "fa fa-save",
            "fa fa-floppy-o",
            "fa fa-square",
            "fa fa-navicon",
            "fa fa-reorder",
            "fa fa-bars",
            "fa fa-list-ul",
            "fa fa-list-ol",
            "fa fa-strikethrough",
            "fa fa-underline",
            "fa fa-table",
            "fa fa-magic",
            "fa fa-truck",
            "fa fa-pinterest",
            "fa fa-pinterest-square",
            "fa fa-google-plus-square",
            "fa fa-google-plus",
            "fa fa-money",
            "fa fa-caret-down",
            "fa fa-caret-up",
            "fa fa-caret-left",
            "fa fa-caret-right",
            "fa fa-columns",
            "fa fa-unsorted",
            "fa fa-sort",
            "fa fa-sort-down",
            "fa fa-sort-desc",
            "fa fa-sort-up",
            "fa fa-sort-asc",
            "fa fa-envelope",
            "fa fa-linkedin",
            "fa fa-rotate-left",
            "fa fa-undo",
            "fa fa-legal",
            "fa fa-gavel",
            "fa fa-dashboard",
            "fa fa-tachometer",
            "fa fa-comment-o",
            "fa fa-comments-o",
            "fa fa-flash",
            "fa fa-bolt",
            "fa fa-sitemap",
            "fa fa-umbrella",
            "fa fa-paste",
            "fa fa-clipboard",
            "fa fa-lightbulb-o",
            "fa fa-exchange",
            "fa fa-cloud-download",
            "fa fa-cloud-upload",
            "fa fa-user-md",
            "fa fa-stethoscope",
            "fa fa-suitcase",
            "fa fa-bell-o",
            "fa fa-coffee",
            "fa fa-cutlery",
            "fa fa-file-text-o",
            "fa fa-building-o",
            "fa fa-hospital-o",
            "fa fa-ambulance",
            "fa fa-medkit",
            "fa fa-fighter-jet",
            "fa fa-beer",
            "fa fa-h-square",
            "fa fa-plus-square",
            "fa fa-angle-double-left",
            "fa fa-angle-double-right",
            "fa fa-angle-double-up",
            "fa fa-angle-double-down",
            "fa fa-angle-left",
            "fa fa-angle-right",
            "fa fa-angle-up",
            "fa fa-angle-down",
            "fa fa-desktop",
            "fa fa-laptop",
            "fa fa-tablet",
            "fa fa-mobile-phone",
            "fa fa-mobile",
            "fa fa-circle-o",
            "fa fa-quote-left",
            "fa fa-quote-right",
            "fa fa-spinner",
            "fa fa-circle",
            "fa fa-mail-reply",
            "fa fa-reply",
            "fa fa-github-alt",
            "fa fa-folder-o",
            "fa fa-folder-open-o",
            "fa fa-smile-o",
            "fa fa-frown-o",
            "fa fa-meh-o",
            "fa fa-gamepad",
            "fa fa-keyboard-o",
            "fa fa-flag-o",
            "fa fa-flag-checkered",
            "fa fa-terminal",
            "fa fa-code",
            "fa fa-mail-reply-all",
            "fa fa-reply-all",
            "fa fa-star-half-empty",
            "fa fa-star-half-full",
            "fa fa-star-half-o",
            "fa fa-location-arrow",
            "fa fa-crop",
            "fa fa-code-fork",
            "fa fa-unlink",
            "fa fa-chain-broken",
            "fa fa-question",
            "fa fa-info",
            "fa fa-exclamation",
            "fa fa-superscript",
            "fa fa-subscript",
            "fa fa-eraser",
            "fa fa-puzzle-piece",
            "fa fa-microphone",
            "fa fa-microphone-slash",
            "fa fa-shield",
            "fa fa-calendar-o",
            "fa fa-fire-extinguisher",
            "fa fa-rocket",
            "fa fa-maxcdn",
            "fa fa-chevron-circle-left",
            "fa fa-chevron-circle-right",
            "fa fa-chevron-circle-up",
            "fa fa-chevron-circle-down",
            "fa fa-html5",
            "fa fa-css3",
            "fa fa-anchor",
            "fa fa-unlock-alt",
            "fa fa-bullseye",
            "fa fa-ellipsis-h",
            "fa fa-ellipsis-v",
            "fa fa-rss-square",
            "fa fa-play-circle",
            "fa fa-ticket",
            "fa fa-minus-square",
            "fa fa-minus-square-o",
            "fa fa-level-up",
            "fa fa-level-down",
            "fa fa-check-square",
            "fa fa-pencil-square",
            "fa fa-external-link-square",
            "fa fa-share-square",
            "fa fa-compass",
            "fa fa-toggle-down",
            "fa fa-caret-square-o-down",
            "fa fa-toggle-up",
            "fa fa-caret-square-o-up",
            "fa fa-toggle-right",
            "fa fa-caret-square-o-right",
            "fa fa-euro",
            "fa fa-eur",
            "fa fa-gbp",
            "fa fa-dollar",
            "fa fa-usd",
            "fa fa-rupee",
            "fa fa-inr",
            "fa fa-cny",
            "fa fa-rmb",
            "fa fa-yen",
            "fa fa-jpy",
            "fa fa-ruble",
            "fa fa-rouble",
            "fa fa-rub",
            "fa fa-won",
            "fa fa-krw",
            "fa fa-bitcoin",
            "fa fa-btc",
            "fa fa-file",
            "fa fa-file-text",
            "fa fa-sort-alpha-asc",
            "fa fa-sort-alpha-desc",
            "fa fa-sort-amount-asc",
            "fa fa-sort-amount-desc",
            "fa fa-sort-numeric-asc",
            "fa fa-sort-numeric-desc",
            "fa fa-thumbs-up",
            "fa fa-thumbs-down",
            "fa fa-youtube-square",
            "fa fa-youtube",
            "fa fa-xing",
            "fa fa-xing-square",
            "fa fa-youtube-play",
            "fa fa-dropbox",
            "fa fa-stack-overflow",
            "fa fa-instagram",
            "fa fa-flickr",
            "fa fa-adn",
            "fa fa-bitbucket",
            "fa fa-bitbucket-square",
            "fa fa-tumblr",
            "fa fa-tumblr-square",
            "fa fa-long-arrow-down",
            "fa fa-long-arrow-up",
            "fa fa-long-arrow-left",
            "fa fa-long-arrow-right",
            "fa fa-apple",
            "fa fa-windows",
            "fa fa-android",
            "fa fa-linux",
            "fa fa-dribbble",
            "fa fa-skype",
            "fa fa-foursquare",
            "fa fa-trello",
            "fa fa-female",
            "fa fa-male",
            "fa fa-gittip",
            "fa fa-gratipay",
            "fa fa-sun-o",
            "fa fa-moon-o",
            "fa fa-archive",
            "fa fa-bug",
            "fa fa-vk",
            "fa fa-weibo",
            "fa fa-renren",
            "fa fa-pagelines",
            "fa fa-stack-exchange",
            "fa fa-arrow-circle-o-right",
            "fa fa-arrow-circle-o-left",
            "fa fa-toggle-left",
            "fa fa-caret-square-o-left",
            "fa fa-dot-circle-o",
            "fa fa-wheelchair",
            "fa fa-vimeo-square",
            "fa fa-turkish-lira",
            "fa fa-try",
            "fa fa-plus-square-o",
            "fa fa-space-shuttle",
            "fa fa-slack",
            "fa fa-envelope-square",
            "fa fa-wordpress",
            "fa fa-openid",
            "fa fa-institution",
            "fa fa-bank",
            "fa fa-university",
            "fa fa-mortar-board",
            "fa fa-graduation-cap",
            "fa fa-yahoo",
            "fa fa-google",
            "fa fa-reddit",
            "fa fa-reddit-square",
            "fa fa-stumbleupon-circle",
            "fa fa-stumbleupon",
            "fa fa-delicious",
            "fa fa-digg",
            "fa fa-pied-piper-pp",
            "fa fa-pied-piper-alt",
            "fa fa-drupal",
            "fa fa-joomla",
            "fa fa-language",
            "fa fa-fax",
            "fa fa-building",
            "fa fa-child",
            "fa fa-paw",
            "fa fa-spoon",
            "fa fa-cube",
            "fa fa-cubes",
            "fa fa-behance",
            "fa fa-behance-square",
            "fa fa-steam",
            "fa fa-steam-square",
            "fa fa-recycle",
            "fa fa-automobile",
            "fa fa-car",
            "fa fa-cab",
            "fa fa-taxi",
            "fa fa-tree",
            "fa fa-spotify",
            "fa fa-deviantart",
            "fa fa-soundcloud",
            "fa fa-database",
            "fa fa-file-pdf-o",
            "fa fa-file-word-o",
            "fa fa-file-excel-o",
            "fa fa-file-powerpoint-o",
            "fa fa-file-photo-o",
            "fa fa-file-picture-o",
            "fa fa-file-image-o",
            "fa fa-file-zip-o",
            "fa fa-file-archive-o",
            "fa fa-file-sound-o",
            "fa fa-file-audio-o",
            "fa fa-file-movie-o",
            "fa fa-file-video-o",
            "fa fa-file-code-o",
            "fa fa-vine",
            "fa fa-codepen",
            "fa fa-jsfiddle",
            "fa fa-life-bouy",
            "fa fa-life-buoy",
            "fa fa-life-saver",
            "fa fa-support",
            "fa fa-life-ring",
            "fa fa-circle-o-notch",
            "fa fa-ra",
            "fa fa-resistance",
            "fa fa-rebel",
            "fa fa-ge",
            "fa fa-empire",
            "fa fa-git-square",
            "fa fa-git",
            "fa fa-y-combinator-square",
            "fa fa-yc-square",
            "fa fa-hacker-news",
            "fa fa-tencent-weibo",
            "fa fa-qq",
            "fa fa-wechat",
            "fa fa-weixin",
            "fa fa-send",
            "fa fa-paper-plane",
            "fa fa-send-o",
            "fa fa-paper-plane-o",
            "fa fa-history",
            "fa fa-circle-thin",
            "fa fa-header",
            "fa fa-paragraph",
            "fa fa-sliders",
            "fa fa-share-alt",
            "fa fa-share-alt-square",
            "fa fa-bomb",
            "fa fa-soccer-ball-o",
            "fa fa-futbol-o",
            "fa fa-tty",
            "fa fa-binoculars",
            "fa fa-plug",
            "fa fa-slideshare",
            "fa fa-twitch",
            "fa fa-yelp",
            "fa fa-newspaper-o",
            "fa fa-wifi",
            "fa fa-calculator",
            "fa fa-paypal",
            "fa fa-google-wallet",
            "fa fa-cc-visa",
            "fa fa-cc-mastercard",
            "fa fa-cc-discover",
            "fa fa-cc-amex",
            "fa fa-cc-paypal",
            "fa fa-cc-stripe",
            "fa fa-bell-slash",
            "fa fa-bell-slash-o",
            "fa fa-trash",
            "fa fa-copyright",
            "fa fa-at",
            "fa fa-eyedropper",
            "fa fa-paint-brush",
            "fa fa-birthday-cake",
            "fa fa-area-chart",
            "fa fa-pie-chart",
            "fa fa-line-chart",
            "fa fa-lastfm",
            "fa fa-lastfm-square",
            "fa fa-toggle-off",
            "fa fa-toggle-on",
            "fa fa-bicycle",
            "fa fa-bus",
            "fa fa-ioxhost",
            "fa fa-angellist",
            "fa fa-cc",
            "fa fa-shekel",
            "fa fa-sheqel",
            "fa fa-ils",
            "fa fa-meanpath",
            "fa fa-buysellads",
            "fa fa-connectdevelop",
            "fa fa-dashcube",
            "fa fa-forumbee",
            "fa fa-leanpub",
            "fa fa-sellsy",
            "fa fa-shirtsinbulk",
            "fa fa-simplybuilt",
            "fa fa-skyatlas",
            "fa fa-cart-plus",
            "fa fa-cart-arrow-down",
            "fa fa-diamond",
            "fa fa-ship",
            "fa fa-user-secret",
            "fa fa-motorcycle",
            "fa fa-street-view",
            "fa fa-heartbeat",
            "fa fa-venus",
            "fa fa-mars",
            "fa fa-mercury",
            "fa fa-intersex",
            "fa fa-transgender",
            "fa fa-transgender-alt",
            "fa fa-venus-double",
            "fa fa-mars-double",
            "fa fa-venus-mars",
            "fa fa-mars-stroke",
            "fa fa-mars-stroke-v",
            "fa fa-mars-stroke-h",
            "fa fa-neuter",
            "fa fa-genderless",
            "fa fa-facebook-official",
            "fa fa-pinterest-p",
            "fa fa-whatsapp",
            "fa fa-server",
            "fa fa-user-plus",
            "fa fa-user-times",
            "fa fa-hotel",
            "fa fa-bed",
            "fa fa-viacoin",
            "fa fa-train",
            "fa fa-subway",
            "fa fa-medium",
            "fa fa-yc",
            "fa fa-y-combinator",
            "fa fa-optin-monster",
            "fa fa-opencart",
            "fa fa-expeditedssl",
            "fa fa-battery-4",
            "fa fa-battery",
            "fa fa-battery-full",
            "fa fa-battery-3",
            "fa fa-battery-three-quarters",
            "fa fa-battery-2",
            "fa fa-battery-half",
            "fa fa-battery-1",
            "fa fa-battery-quarter",
            "fa fa-battery-0",
            "fa fa-battery-empty",
            "fa fa-mouse-pointer",
            "fa fa-i-cursor",
            "fa fa-object-group",
            "fa fa-object-ungroup",
            "fa fa-sticky-note",
            "fa fa-sticky-note-o",
            "fa fa-cc-jcb",
            "fa fa-cc-diners-club",
            "fa fa-clone",
            "fa fa-balance-scale",
            "fa fa-hourglass-o",
            "fa fa-hourglass-1",
            "fa fa-hourglass-start",
            "fa fa-hourglass-2",
            "fa fa-hourglass-half",
            "fa fa-hourglass-3",
            "fa fa-hourglass-end",
            "fa fa-hourglass",
            "fa fa-hand-grab-o",
            "fa fa-hand-rock-o",
            "fa fa-hand-stop-o",
            "fa fa-hand-paper-o",
            "fa fa-hand-scissors-o",
            "fa fa-hand-lizard-o",
            "fa fa-hand-spock-o",
            "fa fa-hand-pointer-o",
            "fa fa-hand-peace-o",
            "fa fa-trademark",
            "fa fa-registered",
            "fa fa-creative-commons",
            "fa fa-gg",
            "fa fa-gg-circle",
            "fa fa-tripadvisor",
            "fa fa-odnoklassniki",
            "fa fa-odnoklassniki-square",
            "fa fa-get-pocket",
            "fa fa-wikipedia-w",
            "fa fa-safari",
            "fa fa-chrome",
            "fa fa-firefox",
            "fa fa-opera",
            "fa fa-internet-explorer",
            "fa fa-tv",
            "fa fa-television",
            "fa fa-contao",
            "fa fa-500px",
            "fa fa-amazon",
            "fa fa-calendar-plus-o",
            "fa fa-calendar-minus-o",
            "fa fa-calendar-times-o",
            "fa fa-calendar-check-o",
            "fa fa-industry",
            "fa fa-map-pin",
            "fa fa-map-signs",
            "fa fa-map-o",
            "fa fa-map",
            "fa fa-commenting",
            "fa fa-commenting-o",
            "fa fa-houzz",
            "fa fa-vimeo",
            "fa fa-black-tie",
            "fa fa-fonticons",
            "fa fa-reddit-alien",
            "fa fa-edge",
            "fa fa-credit-card-alt",
            "fa fa-codiepie",
            "fa fa-modx",
            "fa fa-fort-awesome",
            "fa fa-usb",
            "fa fa-product-hunt",
            "fa fa-mixcloud",
            "fa fa-scribd",
            "fa fa-pause-circle",
            "fa fa-pause-circle-o",
            "fa fa-stop-circle",
            "fa fa-stop-circle-o",
            "fa fa-shopping-bag",
            "fa fa-shopping-basket",
            "fa fa-hashtag",
            "fa fa-bluetooth",
            "fa fa-bluetooth-b",
            "fa fa-percent",
            "fa fa-gitlab",
            "fa fa-wpbeginner",
            "fa fa-wpforms",
            "fa fa-envira",
            "fa fa-universal-access",
            "fa fa-wheelchair-alt",
            "fa fa-question-circle-o",
            "fa fa-blind",
            "fa fa-audio-description",
            "fa fa-volume-control-phone",
            "fa fa-braille",
            "fa fa-assistive-listening-systems",
            "fa fa-asl-interpreting",
            "fa fa-american-sign-language-interpreting",
            "fa fa-deafness",
            "fa fa-hard-of-hearing",
            "fa fa-deaf",
            "fa fa-glide",
            "fa fa-glide-g",
            "fa fa-signing",
            "fa fa-sign-language",
            "fa fa-low-vision",
            "fa fa-viadeo",
            "fa fa-viadeo-square",
            "fa fa-snapchat",
            "fa fa-snapchat-ghost",
            "fa fa-snapchat-square",
            "fa fa-pied-piper",
            "fa fa-first-order",
            "fa fa-yoast",
            "fa fa-themeisle",
            "fa fa-google-plus-circle",
            "fa fa-google-plus-official",
            "fa fa-fa",
            "fa fa-font-awesome",
            "fa fa-handshake-o",
            "fa fa-envelope-open",
            "fa fa-envelope-open-o",
            "fa fa-linode",
            "fa fa-address-book",
            "fa fa-address-book-o",
            "fa fa-vcard",
            "fa fa-address-card",
            "fa fa-vcard-o",
            "fa fa-address-card-o",
            "fa fa-user-circle",
            "fa fa-user-circle-o",
            "fa fa-user-o",
            "fa fa-id-badge",
            "fa fa-drivers-license",
            "fa fa-id-card",
            "fa fa-drivers-license-o",
            "fa fa-id-card-o",
            "fa fa-quora",
            "fa fa-free-code-camp",
            "fa fa-telegram",
            "fa fa-thermometer-4",
            "fa fa-thermometer",
            "fa fa-thermometer-full",
            "fa fa-thermometer-3",
            "fa fa-thermometer-three-quarters",
            "fa fa-thermometer-2",
            "fa fa-thermometer-half",
            "fa fa-thermometer-1",
            "fa fa-thermometer-quarter",
            "fa fa-thermometer-0",
            "fa fa-thermometer-empty",
            "fa fa-shower",
            "fa fa-bathtub",
            "fa fa-s15",
            "fa fa-bath",
            "fa fa-podcast",
            "fa fa-window-maximize",
            "fa fa-window-minimize",
            "fa fa-window-restore",
            "fa fa-times-rectangle",
            "fa fa-window-close",
            "fa fa-times-rectangle-o",
            "fa fa-window-close-o",
            "fa fa-bandcamp",
            "fa fa-grav",
            "fa fa-etsy",
            "fa fa-imdb",
            "fa fa-ravelry",
            "fa fa-eercast",
            "fa fa-microchip",
            "fa fa-snowflake-o",
            "fa fa-superpowers",
            "fa fa-wpexplorer",
            "fa fa-meetup"
        );
        return $font_awesome;
    }

endif;


// function to display the total number of posts view
function eggnews_post_view_display( $postID ) {
	$count_key = 'total_number_of_views';
	$count     = get_post_meta( $postID, $count_key, true );

	$show_or_hide_view = get_theme_mod( 'eggnews_view_counter_option', 'show' );

	if ( $count == '' ) {
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );

		return $show_or_hide_view !== 'show' ? '' : '<span class="post-views"><i class="fa fa-eye"></i>' . '<span class="total-views"> ' . __( '0 View', 'eggnews-pro' ) . '</span></span>';
	} else {
		return $show_or_hide_view !== 'show' ? '' : '<span class="post-views"><i class="fa fa-eye"></i>' . '<span class="total-views"> ' . sprintf( __( '%s Views', 'eggnews-pro' ), $count ) . '</span></span>';
	}
}

                 
 // function to display the total number of posts view on archive
function eggnews_archive_post_view_display( $postID ) {
	$count_key = 'total_number_of_views';
	$count     = get_post_meta( $postID, $count_key, true );

	$show_or_hide_view_on_archive = get_theme_mod( 'eggnews_archive_view_counter_option', 'show' );

	if ( $count == '' ) {
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );

		return $show_or_hide_view_on_archive !== 'show' ? '' : '<span class="post-views"><i class="fa fa-eye"></i>' . '<span class="total-views"> ' . __( '0 View', 'eggnews-pro' ) . '</span></span>';
	} else {
		return $show_or_hide_view_on_archive !== 'show' ? '' : '<span class="post-views"><i class="fa fa-eye"></i>' . '<span class="total-views"> ' . sprintf( __( '%s Views', 'eggnews-pro' ), $count ) . '</span></span>';
	}
}
              

// function to count views for the posts
function eggnews_post_view_setup( $postID ) {
	$count_key = 'total_number_of_views';
	$count     = get_post_meta( $postID, $count_key, true );
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
	} else {
		$count ++;
		update_post_meta( $postID, $count_key, $count );
	}
}

// Adding the number of views count in the WordPress Posts Dashboard
add_filter( 'manage_posts_columns', 'eggnews_posts_column_views' );
add_action( 'manage_posts_custom_column', 'eggnews_posts_custom_column_views', 5, 2 );

function eggnews_posts_column_views( $defaults ) {
	$defaults['post_views'] = __( 'Total Views', 'eggnews-pro' );

	return $defaults;
}

function eggnews_posts_custom_column_views( $column_name, $id ) {
	if ( $column_name === 'post_views' ) {
		echo eggnews_post_view_display( get_the_ID() );
	}
}

if ( ! function_exists( 'eggnews_entry_meta' ) ) :

	/**
	 * Shows meta information of post.
	 */
	function eggnews_entry_meta() {
		eggnews_posted_on();
		eggnews_post_comment();
		if ( 'post' == get_post_type() ) :
			if ( get_theme_mod( 'eggnews_post_view_entry_meta_remove', 0 ) == 0 ) {
				echo eggnews_post_view_display( get_the_ID() );
			}
		
		endif;
	}
endif;

function eggnews_menu_post( $post ) {

}

//=============================================================
// Breadcrumb hook of the theme
//=============================================================
if ( ! function_exists( 'eggnews_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function eggnews_breadcrumb() {
		get_template_part( 'template-parts/breadcrumbs' );
	}

endif;

add_action( 'eggnews_after_header', 'eggnews_breadcrumb', 10 );

require_once( EGGNEWS_PARENT_DIR . '/pro/eggnews-utils.php' );
require_once( EGGNEWS_PARENT_DIR . '/pro/eggnews-menu/class-eggnews-menu.php' );


