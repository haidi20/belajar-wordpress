<?php

/**
 *  Define extra or custom functions
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */
/*
 * social share buttons - displayed on post single page at the bottom of the content
 */
function eggnews_get_social_sharing_bottom() {

	$buffy = '';
	// @todo single-post-thumbnail appears to not be in used! please check
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
	$buffy .= '<div class="teg-post-sharing teg-post-sharing-bottom">';

	$twitter_user_string = get_theme_mod( 'social_tw_link', '' );
	$twitter_user        = substr( $twitter_user_string, strrpos( $twitter_user_string, '/' ) + 1 );
	$twitter_user        = $twitter_user === '' ? false : $twitter_user;
	/**
	 * get Pinterest share description
	 * get it from SEO by Yoast meta (if the plugin is active and the description is set) else use the post title
	 */
	$teg_pinterest_share_description = htmlspecialchars( urlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' );
	//default share buttons
	/**                 
  * Social Share Count Feature                 
  * @package Theme Egg                 
  * @subpackage eggnews-pro                 
  * @since 1.2.0  **/
	$buffy .= '
	<div class="teg-default-sharing">
	<a class="teg-social-sharing-buttons teg-social-facebook" href="https://www.facebook.com/sharer.php?u=' . urlencode( esc_url( get_permalink() ) ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-facebook"></i><div class="teg-social-but-text">' . esc_html( 'Share on Facebook', 'eggnews-pro' ) . '</div><span data-sc-fb="'.get_the_permalink().'"></span></a>
	
	<a class="teg-social-sharing-buttons teg-social-twitter" href="https://twitter.com/intent/tweet?text=' . htmlspecialchars( urlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' ) . '&url=' . urlencode( esc_url( get_permalink() ) ) . '&via=' . urlencode( $twitter_user ? $twitter_user : get_bloginfo( 'name' ) ) . '"><i class="fa fa-twitter"></i><div class="teg-social-but-text">' . esc_html( 'Tweet on twitter', 'eggnews-pro' ) . '</div><span data-sc-tw="'.get_the_permalink().'"></span></a>
	
	<a class="teg-social-sharing-buttons teg-social-google" href="https://plus.google.com/share?url=' . esc_url( get_permalink() ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-google"></i><div class="teg-social-but-text">' . esc_html( 'Share on google+', 'eggnews-pro' ) . '</div><span data-sc-gp="'.get_the_permalink().'"></span></a>
	
	<a class="teg-social-sharing-buttons teg-social-pinterest" href="https://pinterest.com/pin/create/button/?url=' . esc_url( get_permalink() ) . '&amp;media=' . ( ! empty( $image[0] ) ? $image[0] : '' ) . '&description=' . $teg_pinterest_share_description . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-pinterest"></i><div class="teg-social-but-text">' . esc_html( 'Pin to pinterest', 'eggnews-pro' ) . '</div><span data-sc-pr="'.get_the_permalink().'"></span></a>
	
	<a class="teg-social-sharing-buttons teg-social-whatsapp" href="whatsapp://send?text=' . htmlspecialchars( urlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' ) . '%20-%20' . urlencode( esc_url( get_permalink() ) ) . '" ><i class="fa fa-whatsapp"></i></a>
	</div>';

	$buffy .= '</div>';

	return $buffy;
}

/**
 * Enqueue Scripts and styles for admin
 */
function eggnews_admin_scripts_style( $hook ) {

	global $eggnews_version;

	if ( 'widgets.php' != $hook && 'customize.php' != $hook ) {
		return;
	}

	if ( function_exists( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}

	wp_enqueue_script( 'eggnews-widget-image-upload', get_template_directory_uri() . '/assets/js/image-uploader.js', false, esc_attr( $eggnews_version ), true );
	wp_register_script( 'eggnews-media-uploader', get_template_directory_uri() . '/inc/admin/assets/js/media-uploader.js', array( 'jquery' ), 1.70 );
	wp_enqueue_script( 'eggnews-media-uploader' );
	wp_localize_script( 'eggnews-media-uploader', 'eggnews_l10n', array(
		'upload' => __( 'Upload', 'eggnews-pro' ),
		'remove' => __( 'Remove', 'eggnews-pro' )
	) );

	wp_enqueue_script( 'eggnews-admin-script', get_template_directory_uri() . '/inc/admin/assets/js/admin-script.js', array( 'jquery' ), esc_attr( $eggnews_version ), true );

	wp_enqueue_style( 'eggnews-admin-style', get_template_directory_uri() . '/inc/admin/assets/css/admin-style.css', array(), esc_attr( $eggnews_version ) );
}

add_action( 'admin_enqueue_scripts', 'eggnews_admin_scripts_style' );


function eggnews_customize_backend_scripts() {

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/lib/font-awesome/css/font-awesome.css', array(), '4.7.0' );
	wp_enqueue_script( 'eggnews-admin-customizer', get_template_directory_uri() . '/assets/js/eggnews-customizer-controls.js', array(
		'jquery',
	), '20170616', true );

}

add_action( 'customize_controls_enqueue_scripts', 'eggnews_customize_backend_scripts', 10 );

/**
 * Enqueue scripts and styles.
 */
function eggnews_scripts() {
	global $eggnews_version;

	if ( version_compare( $eggnews_version, EGGNEWS_THEME_VER ) == '-1' ){

		$eggnews_version = EGGNEWS_THEME_VER;
	}

	$query_args = array(
		'family' => 'Merriweather',
	);

	$eggnews_googlefonts = array();
	array_push( $eggnews_googlefonts, get_theme_mod( 'eggnews_site_title_font', 'Merriweather:400,600' ) );
	array_push( $eggnews_googlefonts, get_theme_mod( 'eggnews_site_tagline_font', 'Merriweather:400,600' ) );
	array_push( $eggnews_googlefonts, get_theme_mod( 'eggnews_primary_menu_font', 'Merriweather:400,600' ) );
	array_push( $eggnews_googlefonts, get_theme_mod( 'eggnews_all_titles_font', 'Merriweather:400,600' ) );
	array_push( $eggnews_googlefonts, get_theme_mod( 'eggnews_content_font', 'Merriweather:400,600' ) );
	$eggnews_googlefonts = array_unique( $eggnews_googlefonts );
	$eggnews_googlefonts = implode( "|", $eggnews_googlefonts );
	wp_register_style( 'eggnews_googlefonts', '//fonts.googleapis.com/css?family=' . $eggnews_googlefonts );
	wp_enqueue_style( 'eggnews_googlefonts' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/lib/font-awesome/css/font-awesome.min.css', array(), '4.5.0' );
	wp_enqueue_style('socicon', get_template_directory_uri() . '/assets/lib/font-awesome/fonts/socicon.css', array(), '3.5.2');

	wp_enqueue_style( 'eggnews-google-font', add_query_arg( $query_args, "//fonts.googleapis.com/css" ) );
	wp_enqueue_style( 'eggnews-style-1', get_template_directory_uri() . '/assets/css/eggnews.css', array(), esc_attr( $eggnews_version ) );

	wp_enqueue_style( 'eggnews-style', get_stylesheet_uri(), array(), esc_attr( $eggnews_version ) );

	wp_enqueue_style( 'eggnews-responsive', get_template_directory_uri() . '/assets/css/eggnews-responsive.css', array(), esc_attr( $eggnews_version ) );

	wp_enqueue_script( 'jquery-bxslider', get_template_directory_uri() . '/assets/lib/bxslider/jquery.bxslider.min.js', array( 'jquery' ), '4.1.2', true );

	// Start : Owl Carousel

	wp_register_style( 'owl-carousel2-style', get_template_directory_uri() . '/assets/lib/owl/assets/owl.carousel.css', array(), esc_attr( $eggnews_version ) );

	wp_register_style( 'owl-carousel2-theme', get_template_directory_uri() . '/assets/lib/owl/assets/owl.theme.default.css', array(), esc_attr( $eggnews_version ) );

	wp_register_script( 'owl-carousel2-script', get_template_directory_uri() . '/assets/lib/owl/owl.carousel.min.js', array( 'jquery' ), esc_attr( $eggnews_version ), true );

	//End : Owl Carousel
	// Easy Tabs
	wp_register_script( 'eggnews-easy-tabs', get_template_directory_uri() . '/assets/lib/easytabs/jquery.easytabs.min.js', array( 'jquery' ), '20150409', true );
	// End of Easy Tabs

	//Sticky Menu
	$menu_sticky_option = get_theme_mod( 'eggnews_sticky_option', 'enable' );
	if ( $menu_sticky_option != 'disable' ) {
		wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/assets/lib/sticky/jquery.sticky.js', array( 'jquery' ), '20150416', true );

		wp_enqueue_script( 'eggnews-sticky-menu-setting', get_template_directory_uri() . '/assets/lib/sticky/sticky-setting.js', array( 'jquery-sticky' ), '20150309', true );
	}
	
	
		
	
		/**                 
         	* Social Share Counter                 
            * @package Theme Egg                 
            * @subpackage eggnews-pro                 
            * @since 1.2.0
         */ 
         	wp_register_script( 'eggnews-social-share-counter', get_template_directory_uri() . '/assets/lib/social-share-count-js/js/social-share-count.min.js', array(), '4.1.0', true );

         	$menu_social_share_count_option =get_theme_mod('eggnews_social_share_count_option','disable');
         	if ($menu_social_share_count_option !='disable') {
         		wp_enqueue_script( 'eggnews-social-share-counter', get_template_directory_uri() . '/assets/lib/social-share-count-js/js/social-share-count.min.js', array(), '4.1.0', true );
         	}

	
		
	/**                 
        * Eggnews Sticky sidebar on post , page and archive                
        * @package Theme Egg                 
        * @subpackage eggnews-pro                 
        * @since 1.2.0
        */ 


		wp_register_script( 'eggnews-sticky-sidebarr', get_template_directory_uri() . '/assets/lib/theia-sticky-sidebar/theia-sticky-sidebar.min.js', array( 'jquery' ), '1.7.0', true );

		$sidebar_sticky_option =get_theme_mod('eggnews_sticky_sidebar_option','enable');

		if ($sidebar_sticky_option !='disable') {	
			wp_enqueue_script( 'eggnews-sticky-sidebar');	
		}
		

		if(is_single()){
			$sidebar_sticky_option = get_theme_mod('eggnews_sticky_sidebar_on_single_post','disable');
			if ($sidebar_sticky_option != 'disable') {
				wp_enqueue_script('eggnews-sticky-sidebarr');
			}
		}

		if(is_page()){
			$sidebar_sticky_option = get_theme_mod('eggnews_sticky_sidebar_on_page','disable');
			if ($sidebar_sticky_option != 'disable') {
				wp_enqueue_script('eggnews-sticky-sidebarr');
			}
		}

		if(is_archive()){
			$sidebar_sticky_option = get_theme_mod('eggnews_sticky_sidebar_on_archive','disable');
			if ($sidebar_sticky_option != 'disable') {
				wp_enqueue_script('eggnews-sticky-sidebarr');
			}
		}


		wp_enqueue_script( 'eggnews-custom-script', get_template_directory_uri() . '/assets/js/custom-script.js', array( 'jquery-bxslider' ), esc_attr( $eggnews_version ), true );

		if( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	add_action( 'wp_enqueue_scripts', 'eggnews_scripts' );
	function eggnews_website_skin() {
		return
		array(
			'default_skin' => esc_html__( 'Default', 'eggnews-pro' ),
			'dark_skin'    => esc_html__( 'Dark Skin', 'eggnews-pro' ),
		);
	}

	if ( ! function_exists( 'eggnews_website_hover_option' ) ) {
		function eggnews_website_hover_option() {
			return
			array(
				'default'         => esc_html__( 'Default', 'eggnews-pro' ),
				'no_hover_effect' => esc_html__( 'No Hover effect', 'eggnews-pro' ),
			);
		}
	}	

function eggnews_site_title_design() {
	return
	array(
		'default' => __( 'Default', 'eggnews-pro' ),
		'line'    => __( 'Line Style', 'eggnews-pro' ),
		'plain'   => __( 'Plain Style', 'eggnews-pro' )
	);
}

/* ------------------------------------------------------------------------------------------------ */
/**
 * Current date at top header and date format
 */
add_action( 'eggnews_current_date', 'eggnews_current_date_hook' );
if ( ! function_exists( 'eggnews_current_date_hook' ) ):

	function eggnews_current_date_hook() {

		$hide_date = get_theme_mod( 'eggnews_hide_top_header_date', '0' );
		if ( $hide_date ) {
			return;
		}

		$date_option = get_theme_mod( 'eggnews_header_date', 'enable' );
		if ( $date_option != 'disable' ) {
			?>
			
			<?php 
		}
 			
		if ($date_option != 'disable'){ ?>
			<div class="date-section"> <?php
			$date_format_option = get_theme_mod( 'eggnews_date_format_option', 'l, F d, Y');
			switch($date_format_option) {
				case 'l, F d, Y':
				echo esc_html( date_i18n( 'l, F d, Y' ) );
				break;

				case 'l, Y, F d':
				echo esc_html( date_i18n( 'l, Y, F d' ) );
				break;

				default:
				echo esc_html( date_i18n( 'Y, F d, l' ) );
			} ?></div>  <?php
		}	
}	
endif;

/* ------------------------------------------------------------------------------------------------ */
/**
 * News Ticker
 */
add_action( 'eggnews_news_ticker', 'eggnews_news_ticker_hook' );
if ( ! function_exists( 'eggnews_news_ticker_hook' ) ):

	function eggnews_news_ticker_hook() {
		$eggnews_ticker_option = get_theme_mod( 'eggnews_ticker_option', 'enable' );
		if ( $eggnews_ticker_option != 'disable' && is_front_page() ) {
			$eggnews_ticker_caption = get_theme_mod( 'eggnews_ticker_caption', __( 'Latest', 'eggnews-pro' ) );
			?>
			<div class="eggnews-ticker-wrapper">
				<div class="teg-container">
					<span class="ticker-caption"><?php echo esc_html( $eggnews_ticker_caption ); ?></span>
					<div class="ticker-content-wrapper">
						<?php
						$total_posts = get_theme_mod( 'eggnews_ticker_number_of_post', 5 );
						$cat_id      = get_theme_mod( 'eggnews_ticker_category', 0 );
						if ( $cat_id == 0 ) {
							$cat_id = null;
						}
						$ticker_args  = eggnews_query_args( $cat_id, $total_posts );
						$ticker_query = new WP_Query( $ticker_args );
						if ( $ticker_query->have_posts() ) {
							echo '<ul id="teg-newsTicker" class="cS-hidden">';
							while ( $ticker_query->have_posts() ) {
								$ticker_query->the_post();
								?>
								<li>
									<div class="news-post"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</div>
								</li>
								<?php
							}
							echo '</ul>';
						}
						?>
					</div><!-- .ticker-content-wrapper -->
					<div style="clear:both"></div>
				</div><!-- .teg-container -->
			</div>
			<?php
		}
	}

endif;

/* ------------------------------------------------------------------------------------------------ */
/**
 * Define categories lists in array
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'eggnews_category_array' ) ) :

	function eggnews_category_array() {
		$eggnews_categories = get_categories( array( 'hide_empty' => 0 ) );
		foreach ( $eggnews_categories as $eggnews_category ) {
			$eggnews_category_array[ $eggnews_category->term_id ] = $eggnews_category->cat_name;
		}

		return $eggnews_category_array;
	}

endif;

/**
 * categories in dropdown
 *
 * @since 1.2.3
 */
if ( ! function_exists( 'eggnews_category_dropdown' ) ) :

	function eggnews_category_dropdown() {
		$eggnews_categories             = get_categories( array( 'hide_empty' => 0 ) );
		$eggnews_category_dropdown['0'] = esc_html__( 'Select Category', 'eggnews-pro' );
		foreach ( $eggnews_categories as $eggnews_category ) {
			$eggnews_category_dropdown[ $eggnews_category->term_id ] = $eggnews_category->cat_name;
		}

		return $eggnews_category_dropdown;
	}

endif;

if ( ! function_exists( 'eggnews_tags_dropdown' ) ) :
	function eggnews_tags_dropdown() {
		$eggnews_tags               = get_tags( array( 'hide_empty' => 0 ) );
		$eggnews_tags_dropdown['0'] = esc_html__( 'Select Tags', 'eggnews-pro' );
		foreach ( $eggnews_tags as $eggnews_tag ) {
			$eggnews_tags_dropdown[ $eggnews_tag->term_id ] = $eggnews_tag->name;
		}

		return $eggnews_tags_dropdown;
	}
endif;
if ( ! function_exists( 'eggnews_category_dropdown_parameter' ) ) :
	function eggnews_category_dropdown_parameter() {
		$eggnews_category_dropdown_parameter = array(
			'1' => __( 'Category in - All post from either or selected category', 'eggnews-pro' ),
			'2' => __( 'Category and - All post that must have all selected category', 'eggnews-pro' ),
			'3' => __( 'Category not in - All posts except selected category', 'eggnews-pro' ),
		);

		return $eggnews_category_dropdown_parameter;
	}
endif;
if ( ! function_exists( 'eggnews_tags_dropdown_parameter' ) ) :
	function eggnews_tags_dropdown_parameter() {
		$eggnews_tag_dropdown_parameter = array(
			'1' => __( 'Tag in - All post from either or selected tag', 'eggnews-pro' ),
			'2' => __( 'Tag and - All post that must have all selected tag', 'eggnews-pro' ),
			'3' => __( 'Tag not in - All posts except selected tag', 'eggnews-pro' ),
		);

		return $eggnews_tag_dropdown_parameter;
	}
endif;
if ( ! function_exists( 'eggnews_posttype_dropdown' ) ) :

	function eggnews_posttype_dropdown( $public = true ) {

		$args      = array(
			'public' => $public,
		);
		$post_type = get_post_types( $args );

		return $post_type;
	}

endif;


if ( ! function_exists( 'eggnews_taxonomy_dropdown' ) ) :

	function eggnews_taxonomy_dropdown() {

		$args          = array(
			'public' => true,
		);
		$taxonomy_list = get_taxonomies( $args );

		return $taxonomy_list;
	}

endif;

if ( ! function_exists( 'eggnews_terms_dropdown' ) ) :

	function eggnews_terms_dropdown( $taxonomy = 'category' ) {

		$args               = array(
			'hide_empty' => false,
		);
		$terms_list         = get_terms( $taxonomy, $args );
		$term_dropdown['0'] = esc_html__( '-- Select --', 'eggnews-pro' );
		foreach ( $terms_list as $term_single ) {
			$term_dropdown[ $term_single->term_id ] = $term_single->name;
		}

		return $term_dropdown;
	}

endif;

/*
 * Feature slider layout
 */
if ( ! function_exists( 'eggnews_feature_slider_layout' ) ) :

	function eggnews_feature_slider_layout() {
		return apply_filters( 'eggnews_feature_slider_layout', array(
			'left'        => __( 'Left Slider', 'eggnews-pro' ),
			'right'       => __( 'Right Slider', 'eggnews-pro' ),
			'center'      => __( 'Center Slider', 'eggnews-pro' ),
			'slider_only' => __( 'Slider Only', 'eggnews-pro' ),
		) );
	}

endif;


//no of columns
$eggnews_grid_columns = array(
	'1' => __( 'Select No. of Columns', 'eggnews-pro' ),
	'2' => __( '2 Columns', 'eggnews-pro' ),
	'3' => __( '3 Columns', 'eggnews-pro' ),
	'4' => __( '4 Columns', 'eggnews-pro' )
);

/* ------------------------------------------------------------------------------------------------ */
/**
 * Custom function for wp_query args
 */
if ( ! function_exists( 'eggnews_query_args' ) ):

	function eggnews_query_args( $cat_id, $post_count = null, $category_parameter = 1, $eggnews_tag_id = 0, $tag_parameter = 1 ) {

		$parameter_query = 'category__in';

		if ( $category_parameter === 1 ) {
			$parameter_query = 'category__in';
		} else if ( $category_parameter === 2 ) {
			$parameter_query = 'category__and';
		} else if ( $category_parameter === 3 ) {
			$parameter_query = 'category__not_in';
		}
		if ( is_array( $cat_id ) ) {
			if ( count( $cat_id ) == 1 && $cat_id[0] === 0 ) {
				$eggnews_args = array(
					'post_type'           => 'post',
					'posts_per_page'      => $post_count,
					'ignore_sticky_posts' => 1
				);
			} else {
				$eggnews_args = array(
					'post_type'      => 'post',
					$parameter_query => $cat_id,
					'posts_per_page' => $post_count
				);
			}
		} else if ( ! empty( $cat_id ) ) {
			$eggnews_args = array(
				'post_type'      => 'post',
				'cat'            => $cat_id,
				'posts_per_page' => $post_count
			);
		} else {
			$eggnews_args = array(
				'post_type'           => 'post',
				'posts_per_page'      => $post_count,
				'ignore_sticky_posts' => 1
			);
		}

		$tag_parameter_query = 'tag__in';

		if ( $tag_parameter === 1 ) {
			$tag_parameter_query = 'tag__in';
		} else if ( $tag_parameter === 2 ) {
			$tag_parameter_query = 'tag__and';
		} else if ( $tag_parameter === 3 ) {
			$tag_parameter_query = 'tag__not_in';
		}
		if ( is_array( $eggnews_tag_id ) ) {
			if ( count( $eggnews_tag_id ) == 1 && $eggnews_tag_id[0] === 0 ) {

			} else {
				$eggnews_args[ $tag_parameter_query ] = $eggnews_tag_id;

			}
		} else if ( $eggnews_tag_id !== 0 ) {
			$eggnews_args['tag_id'] = $eggnews_tag_id;

		}

		return $eggnews_args;
	}

endif;

/* ------------------------------------------------------------------------------------------------ */
/**
 * block widget title
 */
if ( ! function_exists( 'eggnews_block_title' ) ):

	function eggnews_block_title( $block_title, $block_cat_id ) {
		if ( ! $block_title ) {
			return;
		}
		$block_cat_name = get_cat_name( $block_cat_id );
		$cat_id_class   = '';
		$cat_link       = '';
		if ( ! empty( $block_cat_id ) ) {
			$cat_id_class = 'teg-cat-' . $block_cat_id;
			$cat_link     = get_category_link( $block_cat_id );
		}
		if ( ! empty( $block_title ) ) {
			$teg_widget_title = $block_title;
		} elseif ( ! empty( $block_cat_name ) ) {
			$teg_widget_title = $block_cat_name;
		} else {
			$teg_widget_title = '';
		}
		?>
		<div class="block-header <?php echo esc_attr( $cat_id_class ); ?>">
			<h3 class="block-title">
				<?php
				if ( ! empty( $block_cat_id ) ) {
					?>
					<a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $teg_widget_title ); ?></a>
					<?php
				} else {
					echo esc_html( $teg_widget_title );
				}
				?>
			</h3>
			<?php
			if ( $cat_link ):
				$view_all_text = get_theme_mod( 'view_all_text_options', esc_html__( 'View All', 'eggnews-pro' ) );
				?>
				<a href="<?php echo $cat_link ?>" class="widget-read"><?php echo esc_attr( $view_all_text ); ?></a>
				<?php
			endif;
			?>
		</div>
		<?php
	}

endif;

/* ------------------------------------------------------------------------------------------------ */
/**
 * Posts Categories with dynamic colors
 */
add_action( 'eggnews_post_categories', 'eggnews_post_categories_hook' );
if ( ! function_exists( 'eggnews_post_categories_hook' ) ):

	function eggnews_post_categories_hook() {
		global $post;
		$post_id         = $post->ID;
		$categories_list = get_the_category( $post_id );
		if ( ! empty( $categories_list ) ) {
			?>
			<div class="post-cat-list">
				<?php
				foreach ( $categories_list as $cat_data ) {
					$cat_name = $cat_data->name;
					$cat_id   = $cat_data->term_id;
					$cat_link = get_category_link( $cat_id );
					?>
					<span class="category-button teg-cat-<?php echo esc_attr( $cat_id ); ?>"><a
							href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $cat_name ); ?></a></span>
					<?php
				}
				?>
			</div>
			<?php
		}
	}

endif;

/* ------------------------------------------------------------------------------------------------ */
/**
 * widget posts excerpt in words
 */
if ( ! function_exists( 'eggnews_post_excerpt' ) ):

	function eggnews_post_excerpt( $content, $word_limit ) {
		$get_content   = strip_tags( $content );
		$strip_content = strip_shortcodes( $get_content );
		$excerpt_words = explode( ' ', $strip_content );

		return implode( ' ', array_slice( $excerpt_words, 0, $word_limit ) );
	}

endif;

/* ------------------------------------------------------------------------------------------------ */
/**
 * Define function to show the social media icons
 */
if ( ! function_exists( 'eggnews_social_icons' ) ):

	function eggnews_social_icons() {
		$social_fb_link    = get_theme_mod( 'social_fb_link', '' );
		$social_tw_link    = get_theme_mod( 'social_tw_link', '' );
		$social_gp_link    = get_theme_mod( 'social_gp_link', '' );
		$social_lnk_link   = get_theme_mod( 'social_lnk_link', '' );
		$social_yt_link    = get_theme_mod( 'social_yt_link', '' );
		$social_vm_link    = get_theme_mod( 'social_vm_link', '' );
		$social_pin_link   = get_theme_mod( 'social_pin_link', '' );
		$social_insta_link = get_theme_mod( 'social_insta_link', '' );

		$social_fb_icon = 'fa-facebook';
		$social_fb_icon = apply_filters( 'social_fb_icon', $social_fb_icon );

		$social_tw_icon = 'fa-twitter';
		$social_tw_icon = apply_filters( 'social_tw_icon', $social_tw_icon );

		$social_gp_icon = 'fa-google-plus';
		$social_gp_icon = apply_filters( 'social_gp_icon', $social_gp_icon );

		$social_lnk_icon = 'fa-linkedin';
		$social_lnk_icon = apply_filters( 'social_lnk_icon', $social_lnk_icon );

		$social_yt_icon = 'fa-youtube';
		$social_yt_icon = apply_filters( 'social_yt_icon', $social_yt_icon );

		$social_vm_icon = 'fa-vimeo';
		$social_vm_icon = apply_filters( 'social_vm_icon', $social_vm_icon );

		$social_pin_icon = 'fa-pinterest';
		$social_pin_icon = apply_filters( 'social_pin_icon', $social_pin_icon );

		$social_insta_icon = 'fa-instagram';
		$social_insta_icon = apply_filters( 'social_insta_icon', $social_insta_icon );

		if ( ! empty( $social_fb_link ) ) {
			echo '<span class="social-link"><a href="' . esc_url( $social_fb_link ) . '" target="_blank"><i class="fa ' . esc_attr( $social_fb_icon ) . '"></i></a></span>';
		}
		if ( ! empty( $social_tw_link ) ) {
			echo '<span class="social-link"><a href="' . esc_url( $social_tw_link ) . '" target="_blank"><i class="fa ' . esc_attr( $social_tw_icon ) . '"></i></a></span>';
		}
		if ( ! empty( $social_gp_link ) ) {
			echo '<span class="social-link"><a href="' . esc_url( $social_gp_link ) . '" target="_blank"><i class="fa ' . esc_attr( $social_gp_icon ) . '"></i></a></span>';
		}
		if ( ! empty( $social_lnk_link ) ) {
			echo '<span class="social-link"><a href="' . esc_url( $social_lnk_link ) . '" target="_blank"><i class="fa ' . esc_attr( $social_lnk_icon ) . '"></i></a></span>';
		}
		if ( ! empty( $social_yt_link ) ) {
			echo '<span class="social-link"><a href="' . esc_url( $social_yt_link ) . '" target="_blank"><i class="fa ' . esc_attr( $social_yt_icon ) . '"></i></a></span>';
		}
		if ( ! empty( $social_vm_link ) ) {
			echo '<span class="social-link"><a href="' . esc_url( $social_vm_link ) . '" target="_blank"><i class="fa ' . esc_attr( $social_vm_icon ) . '"></i></a></span>';
		}
		if ( ! empty( $social_pin_link ) ) {
			echo '<span class="social-link"><a href="' . esc_url( $social_pin_link ) . '" target="_blank"><i class="fa ' . esc_attr( $social_pin_icon ) . '"></i></a></span>';
		}
		if ( ! empty( $social_insta_link ) ) {
			echo '<span class="social-link"><a href="' . esc_url( $social_insta_link ) . '" target="_blank"><i class="fa ' . esc_attr( $social_insta_icon ) . '"></i></a></span>';
		}
	}

endif;

/* ------------------------------------------------------------------------------------------------ */
/**
 * Top header social icon section
 */
add_action( 'eggnews_top_social_icons', 'eggnews_top_social_icons_hook' );
if ( ! function_exists( 'eggnews_top_social_icons_hook' ) ):

	function eggnews_top_social_icons_hook() {
		$top_social_icons = get_theme_mod( 'eggnews_header_social_option', 'enable' );
		if ( $top_social_icons != 'disable' ) {
			?>
			<div class="top-social-wrapper">
				<?php eggnews_social_icons(); ?>
			</div><!-- .top-social-wrapper -->
			<?php
		}
	}

endif;

/* ------------------------------------------------------------------------------------------------ */

/**
 * Add cat id in menu class
 */
function eggnews_category_nav_class( $classes, $item ) {
	if ( 'category' == $item->object ) {
		$category  = get_category( $item->object_id );
		$classes[] = 'teg-cat-' . $category->term_id;
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'eggnews_category_nav_class', 10, 2 );

/* ------------------------------------------------------------------------------------------------ */
/**
 * Generate darker color
 * Source: https://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 */
if ( ! function_exists( 'eggnews_hover_color' ) ) :

	function eggnews_hover_color( $hex, $steps ) {
		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = max( - 255, min( 255, $steps ) );

		// Normalize into a six character long hex string
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
		}

		// Split into three parts: R, G and B
		$color_parts = str_split( $hex, 2 );
		$return      = '#';

		foreach ( $color_parts as $color ) {
			$color = hexdec( $color ); // Convert to decimal
			$color = max( 0, min( 255, $color + $steps ) ); // Adjust color
			$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
		}

		return $return;
	}

endif;

/* ------------------------------------------------------------------------------------------------ */
/**
 * Function define about page/post/archive sidebar
 */
if ( ! function_exists( 'eggnews_sidebar' ) ):

	function eggnews_sidebar() {
		global $post;
		if ( is_single() || is_page() ) {
			$sidebar_meta_option = get_post_meta( $post->ID, 'eggnews_sidebar_location', true );
		}

		if ( is_home() ) {
			$set_id              = get_option( 'page_for_posts' );
			$sidebar_meta_option = get_post_meta( $set_id, 'eggnews_sidebar_location', true );
		}

		if ( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
			$sidebar_meta_option = 'default_sidebar';
		}

		$eggnews_archive_sidebar      = get_theme_mod( 'eggnews_archive_sidebar', 'right_sidebar' );
		$eggnews_post_default_sidebar = get_theme_mod( 'eggnews_default_post_sidebar', 'right_sidebar' );
		$eggnews_page_default_sidebar = get_theme_mod( 'eggnews_default_page_sidebar', '	right_sidebar' );

		if ( $sidebar_meta_option == 'default_sidebar' ) {
			if ( is_single() ) {
				if ( $eggnews_post_default_sidebar == 'right_sidebar' ) {
					get_sidebar();
				} elseif ( $eggnews_post_default_sidebar == 'left_sidebar' ) {
					get_sidebar( 'left' );
				}
			} elseif ( is_page() ) {
				if ( $eggnews_page_default_sidebar == 'right_sidebar' ) {
					get_sidebar();
				} elseif ( $eggnews_page_default_sidebar == 'left_sidebar' ) {
					get_sidebar( 'left' );
				}
			} elseif ( $eggnews_archive_sidebar == 'right_sidebar' ) {
				get_sidebar();
			} elseif ( $eggnews_archive_sidebar == 'left_sidebar' ) {
				get_sidebar( 'left' );
			}
		} elseif ( $sidebar_meta_option == 'right_sidebar' ) {
			get_sidebar();
		} elseif ( $sidebar_meta_option == 'left_sidebar' ) {
			get_sidebar( 'left' );
		}
	}

endif;

/* ------------------------------------------------------------------------------------------------ */
/**
 * Get author info
 */
add_action( 'eggnews_author_box', 'eggnews_author_box_hook' );
if ( ! function_exists( 'eggnews_author_box_hook' ) ):

	function eggnews_author_box_hook() {
		global $post;
		$author_id             = $post->post_author;
		$author_avatar         = get_avatar( $author_id, '132' );
		$author_nickname       = get_the_author_meta( 'display_name' );
		$eggnews_author_option = get_theme_mod( 'eggnews_author_box_option', 'show' );
		if ( $eggnews_author_option != 'hide' ) {
			?>
			<div class="eggnews-author-wrapper clearfix">
				<div class="author-avatar">
					<a class="author-image"
					   href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo $author_avatar; ?></a>
				</div><!-- .author-avatar -->
				<div class="author-desc-wrapper">
					<a class="author-title"
					   href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( $author_nickname ); ?></a>
					<div class="author-description"><?php echo get_the_author_meta( 'description' ); ?></div>
					<a href="<?php echo esc_url( get_the_author_meta( 'user_url' ) ); ?>"
					   target="_blank"><?php echo esc_url( get_the_author_meta( 'user_url' ) ); ?></a>
				</div><!-- .author-desc-wrapper-->
			</div><!--eggnews-author-wrapper-->
			<?php
		}
	}

endif;

/* ------------------------------------------------------------------------------------------------ */
/**
 * Related articles
 */
add_action( 'eggnews_related_articles', 'eggnews_related_articles_hook' );
if ( ! function_exists( 'eggnews_related_articles_hook' ) ):

	function eggnews_related_articles_hook() {
		$eggnews_related_option = esc_attr( get_theme_mod( 'eggnews_related_articles_option', 'enable' ) );
		$eggnews_related_title  = get_theme_mod( 'eggnews_related_articles_title', __( 'Related Articles', 'eggnews-pro' ) );
		if ( $eggnews_related_option != 'disable' ) {
			?>
			<div class="related-articles-wrapper">
				<div class="widget-title-wrapper">
					<h2 class="related-title"><?php echo esc_html( $eggnews_related_title ); ?></h2>
				</div>
				<?php
				global $post;
				if ( empty( $post ) ) {
					$post_id = '';
				} else {
					$post_id = $post->ID;
				}

				$eggnews_related_type = get_theme_mod( 'eggnews_related_articles_type', 'category' );
				$related_post_count   = 3;
				$related_post_count   = apply_filters( 'related_posts_count', $related_post_count );

				// Define related post arguments
				$related_args = array(
					'no_found_rows'          => true,
					'update_post_meta_cache' => false,
					'update_post_term_cache' => false,
					'ignore_sticky_posts'    => 1,
					'orderby'                => 'rand',
					'post__not_in'           => array( $post_id ),
					'posts_per_page'         => $related_post_count
				);


				if ( $eggnews_related_type == 'tag' ) {
					$tags = wp_get_post_tags( $post_id );
					if ( $tags ) {
						$tag_ids = array();
						foreach ( $tags as $tag_ed ) {
							$tag_ids[] = $tag_ed->term_id;
						}
						$related_args['tag__in'] = $tag_ids;
					}
				} else {
					$categories = get_the_category( $post_id );
					if ( $categories ) {
						$category_ids = array();
						foreach ( $categories as $category_ed ) {
							$category_ids[] = $category_ed->term_id;
						}
						$related_args['category__in'] = $category_ids;
					}
				}

				$related_query = new WP_Query( $related_args );
				if ( $related_query->have_posts() ) {
					echo '<div class="related-posts-wrapper clearfix">';
					while ( $related_query->have_posts() ) {
						$related_query->the_post();
						?>
						<div class="single-post-wrap">
							<div class="post-thumb-wrapper">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<figure><?php the_post_thumbnail( 'eggnews-block-medium' ); ?></figure>
								</a>
							</div><!-- .post-thumb-wrapper -->
							<div class="related-content-wrapper">
								<?php do_action( 'eggnews_post_categories' ); ?>
								<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<div class="post-meta-wrapper">
									<?php eggnews_posted_on(); ?>
								</div>
								<?php the_excerpt(); ?>
							</div><!-- related-content-wrapper -->
						</div><!--. single-post-wrap -->
						<?php
					}
					echo '</div>';
				}
				wp_reset_postdata();
				?>
			</div><!-- .related-articles-wrapper -->
			<?php
		}
	}

endif;

function eggnews_wp_footer_render_box() {

	$more_stories_section = get_theme_mod( 'eggnews_more_stories_settings' );

	if ( empty( $more_stories_section['show_more_stories'] ) || $more_stories_section['show_more_stories'] === true ) {
		return;
	}
	$more_story_post_category = absint( isset( $more_stories_section['more_stories_post_category'] ) && $more_stories_section['more_stories_post_category'] > 0 ? $more_stories_section['more_stories_post_category'] : 0 );

	global $post;
	?>
	<div class="teg-more-articles-box">
		<i class="fa fa-window-close teg-close-more-articles-box"></i>
		<?php $more_stories_section = get_theme_mod( 'eggnews_more_stories_settings' ); ?>
		<span class="teg-more-articles-box-title"><?php
			$more_stories_text = isset( $more_stories_section['more_stories_text'] ) ? $more_stories_section['more_stories_text'] : __( 'MORE STORIES', 'eggnews-pro' );
			echo esc_html( $more_stories_text );
			?></span>
		<div class="teg-content-more-articles-box">
			<?php
			$args = array(// Arguments for your query.
				'posts_per_page' => 2,
				'post_type'      => 'post',
				'meta_key'       => '_thumbnail_id',
				'orderby'        => 'rand',
			);
			if ( $more_story_post_category > 0 ) {
				$args['cat'] = $more_story_post_category;
			}

			// Custom query.
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					?>
					<div class="single-post-wrapper">
						<div class="teg-thumb">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<figure><?php the_post_thumbnail( 'eggnews-footer-readmore-thumbnail' ); ?></figure>
							</a>
						</div>
						<div class="post-content-wrapper">

							<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="post-meta-wrapper">
								<?php eggnews_posted_date(); ?>
							</div>

						</div><!-- .post-meta-wrapper -->
					</div>
					<?php
				}
			}
			?>

		</div>
	</div>
	<?php
}

//end function render

add_action( 'wp_footer', 'eggnews_wp_footer_render_box' );
/* ------------------------------------------------------------------------------------------------ */
/**
 * Filter the category title
 */
if ( ! function_exists( 'eggnews_get_the_archive_title' ) ) {

	add_filter( 'get_the_archive_title', 'eggnews_get_the_archive_title', 10, 1 );

	function eggnews_get_the_archive_title( $title ) {

		if ( is_category() ) {
			$title = single_cat_title( '', false );
		}

		return $title;
	}

}

function eggnews_exclude_duplicate_posts() {

	return array();
}

function eggnews_append_excluded_duplicate_posts( $featured_posts ) {
	global $eggnews_duplicate_posts;

	if ( get_theme_mod( 'eggnews_unique_post_system', 0 ) == 1 ) {
		$post_ids                = wp_list_pluck( $featured_posts->posts, 'ID' );
		$eggnews_duplicate_posts = array_unique( array_merge( $eggnews_duplicate_posts, $post_ids ) );
	} else {
		return;
	}
}