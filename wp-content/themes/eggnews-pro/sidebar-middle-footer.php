<?php
/**
 * The Sidebar containing the middle footer widget areas.
 *
 * @package Theme Egg
 * @subpackage Eggnews
 * @since 1.0.0
 */

/**
 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */

if( !is_active_sidebar( 'eggnews_middle_footer_one' ) &&
	!is_active_sidebar( 'eggnews_middle_footer_two' ) &&
    !is_active_sidebar( 'eggnews_middle_footer_three' ) &&
    !is_active_sidebar( 'eggnews_middle_footer_four' ) ) {
	return;
}
$eggnews_middle_footer_layout = get_theme_mod( 'middle_footer_widget_option', 'column4' );
$footer_parallax = get_theme_mod('preloader_image_eggnews');

?>

<div id="middle-footer" class="footer-widgets-wrapper clearfix  <?php echo esc_attr( $eggnews_middle_footer_layout ); ?>" style="<?php echo ($footer_parallax) ? 'background: transparent': ''; ?>">
	<div class="teg-container">
		<div class="footer-widgets-area clearfix">
            <div class="teg-footer-widget-wrapper clearfix">
            		<div class="teg-first-footer-widget teg-footer-widget">
            			<?php
                			if ( !dynamic_sidebar( 'eggnews_middle_footer_one' ) ):
                			endif;
            			?>
            		</div>
        		<?php if( $eggnews_middle_footer_layout != 'column1' ){ ?>
                    <div class="teg-second-footer-widget teg-footer-widget">
            			<?php
                			if ( !dynamic_sidebar( 'eggnews_middle_footer_two' ) ):
                			endif;
            			?>
            		</div>
                <?php } ?>
                <?php if( $eggnews_middle_footer_layout == 'column3' || $eggnews_middle_footer_layout == 'column4' ){ ?>
                    <div class="teg-third-footer-widget teg-footer-widget">
      
                       <?php
                           if ( !dynamic_sidebar( 'eggnews_middle_footer_three' ) ):
                           endif;
                       ?>
                    </div>
                <?php } ?>
                <?php if( $eggnews_middle_footer_layout == 'column4' ){ ?>
                    <div class="teg-fourth-footer-widget teg-footer-widget">
                       <?php
                           if ( !dynamic_sidebar( 'eggnews_middle_footer_four' ) ):
                           endif;
                       ?>
                    </div>
                <?php } ?>
            </div><!-- .teg-footer-widget-wrapper -->
		</div><!-- .footer-widgets-area -->
	</div><!-- .nt-container -->
</div><!-- #top-footer -->
