<?php
/**
 * Displays header style
 *
 * @package WordPress
 * @subpackage EggNews_Pro
 * @since 1.0.0
 * @version 1.0.0
 */
$header_style = get_theme_mod( 'eggnews_header_style_option', 'style-4' );
?>
<header id="masthead" class="site-header <?php echo $header_style ?>">
    <?php get_template_part( 'template-parts/header/header', 'image' ); ?>
    <?php do_action( 'eggnews_news_ticker' ); ?>
    <div class="top-header-section">
        <div class="teg-container">
            <div class="top-left-header">
                <?php do_action( 'eggnews_current_date' ); ?>
                <nav id="top-header-navigation" class="top-navigation">
	                <?php wp_nav_menu(
		                apply_filters( 'eggnews-top-menu', array(
			                'theme_location'  => 'top-header',
			                'container_class' => 'top-menu',
			                'fallback_cb'     => false,
			                'items_wrap'      => '<ul>%3$s</ul>',

		                ) ) ); ?>
                </nav>
            </div>
            <?php do_action( 'eggnews_top_social_icons' ); ?>
        </div> <!-- teg-container end -->
    </div><!-- .top-header-section -->

    <div class="logo-ads-wrapper clearfix">
        <div class="teg-container">
            <div class="site-branding">
                <?php if ( the_custom_logo() ) { ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div><!-- .site-logo -->
                <?php } ?>
                <?php
                $site_title_option = get_theme_mod( 'header_textcolor' );
                if ( $site_title_option != 'blank' ) {
                    ?>
                    <div class="site-title-wrapper">
                        <?php
                        if ( is_front_page() && is_home() ) : ?>
                            <h1 id="site-title" class="site-title"><a
                                    href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                    rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php else : ?>
                            <p id="site-title" class="site-title"><a
                                    href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                    rel="home"><?php bloginfo( 'name' ); ?></a></p>
                            <?php
                        endif;

                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ) : ?>
                            <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                            <?php
                        endif; ?>
                    </div><!-- .site-title-wrapper -->
                    <?php
                }
                ?>
            </div><!-- .site-branding -->
            <?php
            $eggnews_google_ad_option = get_theme_mod('eggnews_google_ad_option', 'disable');
            ?>
            <div class="header-ads-wrapper <?php if ($eggnews_google_ad_option === 'enable') {
                echo 'google-adsence';
            } ?>"><?php
                if ( is_active_sidebar( 'eggnews_header_ads_area' ) ) {
                    if ( ! dynamic_sidebar( 'eggnews_header_ads_area' ) ):
                    endif;
                }
                ?>
            </div><!-- .header-ads-wrapper -->
        </div>
    </div><!-- .logo-ads-wrapper -->

    <div id="teg-menu-wrap" class="bottom-header-wrapper clearfix">
        <div class="teg-container">
            <?php if (get_theme_mod('eggnews_home_option', 'enable') === 'enable') { ?>   
                <div class="home-icon"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"> <i
                    class="<?php echo esc_attr(eggnews_get_icon( 'eggnews_home_icon_option', 'fa fa-home' )) ?>"> </i> </a></div>
                <?php } ?>
                <a href="javascript:void(0)" class="menu-toggle"> <i class="<?php echo esc_attr(eggnews_get_icon('eggnews_nav_icon_option' ,'fa fa-navicon' )) ?>"> </i> </a>
            <nav id="site-navigation" class="main-navigation">

                <?php wp_nav_menu(
	                apply_filters( 'eggnews_primary_menu', array(
		                'theme_location'  => 'primary',
		                'container_class' => 'menu',
		                'items_wrap'      => '<ul class="parent-list teg_mega_menu">%3$s</ul>'

	                ) ) ); ?>
            </nav><!-- .main-navigation -->
            <?php eggnews_random_post(); ?>
            <?php if (get_theme_mod('eggnews_search_option', 'enable') === 'enable') { ?>
                <div class="header-search-wrapper">
                    <span class="search-main"><i class="<?php echo esc_attr(eggnews_get_icon('eggnews_search_icon_option', 'fa fa-search' )) ?>"></i></span>
                    <div class="search-form-main clearfix">
                        <?php get_search_form(); ?>
                    </div>
                </div><!-- .header-search-wrapper -->
            <?php } ?>


        </div><!-- .teg-container -->
    </div><!-- #teg-menu-wrap -->


</header><!-- #masthead -->
