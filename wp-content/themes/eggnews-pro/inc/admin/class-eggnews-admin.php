<?php
/**
 * EggNews Admin Class.
 *
 * @author  ThemeEgg
 * @package EggNews
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'EggNews_Admin' ) ) :

	/**
	 * EggNews_Admin Class.
	 */
	class EggNews_Admin {

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
			add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
		}

		/**
		 * Add admin menu.
		 */
		public function admin_menu() {
			$theme = wp_get_theme( get_stylesheet() );

			$page = add_theme_page( esc_html__( 'About', 'eggnews-pro' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'eggnews-pro' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'eggnews-welcome', array(
				$this,
				'welcome_screen'
			) );
			add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
		}

		/**
		 * Enqueue styles.
		 */
		public function enqueue_styles() {
			global $eggnews_version;

			wp_enqueue_style( 'eggnews-welcome-admin', get_template_directory_uri() . '/inc/admin/assets/css/welcome-admin.css', array(), $eggnews_version );
		}

		/**
		 * Add admin notice.
		 */
		public function admin_notice() {
			global $eggnews_version, $pagenow;
			wp_enqueue_style( 'eggnews-message', get_template_directory_uri() . '/inc/admin/assets/css/admin-notices.css', array(), $eggnews_version );

			// Let's bail on theme activation.
			if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
				add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
				update_option( 'eggnews_admin_notice_welcome', 1 );

				// No option? Let run the notice wizard again..
			} elseif ( ! get_option( 'eggnews_admin_notice_welcome' ) ) {
				add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			}
		}

		/**
		 * Hide a notice if the GET variable is set.
		 */
		public static function hide_notices() {
			if ( isset( $_GET['eggnews-hide-notice'] ) && isset( $_GET['_eggnews_notice_nonce'] ) ) {
				if ( ! wp_verify_nonce( $_GET['_eggnews_notice_nonce'], 'eggnews_hide_notices_nonce' ) ) {
					wp_die( __( 'Action failed. Please refresh the page and retry.', 'eggnews-pro' ) );
				}

				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( __( 'Cheatin&#8217; huh?', 'eggnews-pro' ) );
				}

				$hide_notice = sanitize_text_field( $_GET['eggnews-hide-notice'] );
				update_option( 'eggnews_admin_notice_' . $hide_notice, 1 );
			}
		}

		/**
		 * Show welcome notice.
		 */
		public function welcome_notice() {
			?>
			<div id="message" class="updated eggnews-message">
				<a class="eggnews-message-close notice-dismiss"
				   href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'eggnews-hide-notice', 'welcome' ) ), 'eggnews_hide_notices_nonce', '_eggnews_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'eggnews-pro' ); ?></a>
				<p><?php
					/* translators: 1: anchor tag start, 2: anchor tag end*/
					printf( esc_html__( 'Welcome! Thank you for choosing eggnews! To fully take advantage of the best our theme can offer please make sure you visit our %1$swelcome page%1$s.', 'eggnews-pro' ), '<a href="' . esc_url( admin_url( 'themes.php?page=eggnews-welcome' ) ) . '">', '</a>' );
					?></p>
				<p class="submit">
					<a class="button-secondary"
					   href="<?php echo esc_url( admin_url( 'themes.php?page=eggnews-welcome' ) ); ?>"><?php esc_html_e( 'Get started with EggNewsPro', 'eggnews-pro' ); ?></a>
				</p>
			</div>
			<?php
		}

		/**
		 * Intro text/links shown to all about pages.
		 *
		 * @access private
		 */
		private function intro() {
			global $eggnews_version;
			$theme = wp_get_theme( get_stylesheet() );
			// Drop minor version if 0
			$major_version = substr( $eggnews_version, 0, 3 );
			$major_version = $eggnews_version;
			?>
			<div class="eggnews-theme-info">
				<h1>
					<?php esc_html_e( 'About', 'eggnews-pro' ); ?>
					<?php echo $theme->display( 'Name' ); ?>
					<?php printf( '%s', $major_version ); ?>
				</h1>

				<div class="welcome-description-wrap">
					<div class="about-text"><?php echo $theme->display( 'Description' ); ?></div>

					<div class="eggnews-screenshot">
						<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" alt=""/>
					</div>
				</div>
			</div>

			<p class="eggnews-actions">
				<a target="_blank" href="<?php echo esc_url( 'https://themeegg.com/downloads/eggnews-pro-wordpress-theme/' ); ?>"
				   class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'eggnews-pro' ); ?></a>

				<a target="_blank" href="<?php echo esc_url( apply_filters( 'eggnews_theme_url', 'https://demo.themeegg.com/themes/eggnews-pro/' ) ); ?>"
				   class="button button-secondary docs"
				   target="_blank"><?php esc_html_e( 'View Demo', 'eggnews-pro' ); ?></a>

				<a href="<?php echo esc_url( apply_filters( 'eggnews_theme_url', 'https://wordpress.org/support/view/theme-reviews/eggnews?filter=5#postform' ) ); ?>"
				   class="button button-secondary docs"
				   target="_blank"><?php esc_html_e( 'Rate free theme', 'eggnews-pro' ); ?></a>
			</p>

			<h2 class="nav-tab-wrapper">
				<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && $_GET['page'] == 'eggnews-welcome' ) {
					echo 'nav-tab-active';
				} ?>"
				   href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'eggnews-welcome' ), 'themes.php' ) ) ); ?>">
					<?php echo $theme->display( 'Name' ); ?>
				</a>
				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) {
					echo 'nav-tab-active';
				} ?>" href="<?php echo esc_url( admin_url( add_query_arg( array(
					'page' => 'eggnews-welcome',
					'tab'  => 'changelog'
				), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Changelog', 'eggnews-pro' ); ?>
				</a>
			</h2>
			<?php
		}

		/**
		 * Welcome screen page.
		 */
		public function welcome_screen() {
			$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( $_GET['tab'] );

			// Look for a {$current_tab}_screen method.
			if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
				return $this->{$current_tab . '_screen'}();
			}

			// Fallback to about screen.
			return $this->about_screen();
		}

		/**
		 * Output the about screen.
		 */
		public function about_screen() {
			$theme = wp_get_theme( get_template() );
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<div class="changelog point-releases">
					<div class="under-the-hood two-col">

						<div class="col">
							<h3><?php esc_html_e( 'Theme Customizer', 'eggnews-pro' ); ?></h3>
							<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'eggnews-pro' ) ?></p>
							<p><a href="<?php echo admin_url( 'customize.php' ); ?>"
							      class="button button-secondary"><?php esc_html_e( 'Customize', 'eggnews-pro' ); ?></a>
							</p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Documentation', 'eggnews-pro' ); ?></h3>
							<p><?php esc_html_e( 'Please view our documentation page to setup the theme.', 'eggnews-pro' ) ?></p>
							<p><a href="<?php echo esc_url( 'https://docs.themeegg.com/docs/eggnews/' ); ?>"
							      class="button button-secondary"><?php esc_html_e( 'Documentation', 'eggnews-pro' ); ?></a>
							</p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Got theme support question?', 'eggnews-pro' ); ?></h3>
							<p><?php esc_html_e( 'Please put it in our dedicated support forum.', 'eggnews-pro' ) ?></p>
							<p><a href="<?php echo esc_url( 'https://support.themeegg.com' ); ?>"
							      class="button button-secondary"><?php esc_html_e( 'Support', 'eggnews-pro' ); ?></a></p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Any question about this theme or us?', 'eggnews-pro' ); ?></h3>
							<p><?php esc_html_e( 'Please send it via our sales contact page.', 'eggnews-pro' ) ?></p>
							<p><a href="<?php echo esc_url( 'https://themeegg.com/contact/' ); ?>"
							      class="button button-secondary"><?php esc_html_e( 'Contact Page', 'eggnews-pro' ); ?></a>
							</p>
						</div>

						<div class="col">
							<h3>
								<?php
								esc_html_e( 'Translate', 'eggnews-pro' );
								echo ' ' . $theme->display( 'Name' );
								?>
							</h3>
							<p><?php esc_html_e( 'Click below to translate this theme into your own language.', 'eggnews-pro' ) ?></p>
							<p>
								<a href="<?php echo esc_url( 'https://translate.wordpress.org/projects/wp-themes/eggnews' ); ?>"
								   class="button button-secondary">
									<?php
									esc_html_e( 'Translate', 'eggnews-pro' );
									echo ' ' . $theme->display( 'Name' );
									?>
								</a>
							</p>
						</div>
					</div>
				</div>

				<div class="return-to-dashboard eggnews">
					<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
						<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
							<?php is_multisite() ? esc_html_e( 'Return to Updates', 'eggnews-pro' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'eggnews-pro' ); ?>
						</a> |
					<?php endif; ?>
					<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'eggnews-pro' ) : esc_html_e( 'Go to Dashboard', 'eggnews-pro' ); ?></a>
				</div>
			</div>
			<?php
		}

		/**
		 * Output the changelog screen.
		 */
		public function changelog_screen() {
			global $wp_filesystem;

			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php esc_html_e( 'View changelog below:', 'eggnews-pro' ); ?></p>

				<?php
				$changelog_file = apply_filters( 'eggnews_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog      = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
				?>
			</div>
			<?php
		}

		/**
		 * Parse changelog from readme file.
		 *
		 * @param  string $content
		 *
		 * @return string
		 */
		private function parse_changelog( $content ) {
			$matches   = null;
			$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
			$changelog = '';

			if ( preg_match( $regexp, $content, $matches ) ) {
				$changes = explode( '\r\n', trim( $matches[1] ) );

				$changelog .= '<pre class="changelog">';

				foreach ( $changes as $index => $line ) {
					$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
				}

				$changelog .= '</pre>';
			}

			return wp_kses_post( $changelog );
		}


		/**
		 * Output the supported plugins screen.
		 */
		public function supported_plugins_screen() {
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php esc_html_e( 'This theme recommends following plugins:', 'eggnews-pro' ); ?></p>
				<ol>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/social-icons/' ); ?>"
					       target="_blank"><?php esc_html_e( 'Social Icons', 'eggnews-pro' ); ?></a>
						<?php esc_html_e( ' by ThemeEgg', 'eggnews-pro' ); ?>
					</li>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/easy-social-sharing/' ); ?>"
					       target="_blank"><?php esc_html_e( 'Easy Social Sharing', 'eggnews-pro' ); ?></a>
						<?php esc_html_e( ' by ThemeEgg', 'eggnews-pro' ); ?>
					</li>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/contact-form-7/' ); ?>"
					       target="_blank"><?php esc_html_e( 'Contact Form 7', 'eggnews-pro' ); ?></a></li>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/wp-pagenavi/' ); ?>"
					       target="_blank"><?php esc_html_e( 'WP-PageNavi', 'eggnews-pro' ); ?></a></li>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/woocommerce/' ); ?>"
					       target="_blank"><?php esc_html_e( 'WooCommerce', 'eggnews-pro' ); ?></a></li>
					<li>
						<a href="<?php echo esc_url( 'https://wordpress.org/plugins/polylang/' ); ?>"
						   target="_blank"><?php esc_html_e( 'Polylang', 'eggnews-pro' ); ?></a>
						<?php esc_html_e( 'Fully Compatible in Pro Version', 'eggnews-pro' ); ?>
					</li>
					<li>
						<a href="<?php echo esc_url( 'https://wpml.org/' ); ?>"
						   target="_blank"><?php esc_html_e( 'WPML', 'eggnews-pro' ); ?></a>
						<?php esc_html_e( 'Fully Compatible in Pro Version', 'eggnews-pro' ); ?>
					</li>
				</ol>

			</div>
			<?php
		}

		/**
		 * Output the free vs pro screen.
		 */
		public function free_vs_pro_screen() {
			?>

			<?php
		}
	}

endif;

return new EggNews_Admin();
