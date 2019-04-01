<?php
/**
* The template for displaying the footer.
*
* Contains the closing of the #content div and all content after.
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package Theme Egg
* @subpackage Eggnews
* @since 1.0.0
*/

?>
</div><!--.teg-container-->
</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php $parallax_footer = get_theme_mod('parallax_footer_eggnews', ''); 
		if(!empty($parallax_footer)) {
			/**                 
			* Parallax Feature                 
			* @package Theme Egg                 
			* @subpackage eggnews-pro                 
			* @since 1.2.0   
			*/ ?> 
			<div class="parallax" style='background-image: url("<?php echo esc_url($parallax_footer); ?>");'>
				<div class="parallax-content"><?php }?>   	
				<?php get_sidebar( 'top-footer' ); ?>
				<?php get_sidebar( 'middle-footer' ); ?>
				<?php if($parallax_footer) { ?>
				</div>
			</div>
		<?php } ?>
		<div id="bottom-footer" class="sub-footer-wrapper clearfix">
			<div class="teg-container">
				<?php do_action( 'eggnews_footer_copyright' ); ?>
				<nav id="footer-navigation" class="sub-footer-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container_class' => 'footer-menu', 'fallback_cb' => false, 'items_wrap' => '<ul>%3$s</ul>' ) ); ?>
				</nav>
			</div>
		</div><!-- .sub-footer-wrapper -->
	</footer><!-- #colophon -->
		<div id="teg-scrollup" class="animated arrow-hide">
			<i class="fa fa-chevron-up"></i>
		</div>
</div><!-- #page -->


<?php wp_footer(); ?>

</body>
</html>





