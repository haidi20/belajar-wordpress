<?php
defined( 'ABSPATH' ) or exit;

class Eggnews_Pro_Widgets {

	function __construct() {
		$this->require_files();
		$this->hooks_filters();
	}

	function enqueue_scripts() {
		wp_enqueue_script( "jquery-ui-core", array( 'jquery' ) );
		wp_enqueue_script( "jquery-ui-dialog", array( 'jquery' ) );
		wp_enqueue_style( 'wp-jquery-ui-dialog' );
		wp_enqueue_script( 'jquery.simpleWeather', get_template_directory_uri() . '/pro/assets/js/jquery.simpleWeather.min.js', array( 'jquery' ), '3.1.0', false );
	}

	function admin_enqueue_scripts() {
		wp_enqueue_script( 'jquery.simpleWeather', get_template_directory_uri() . '/pro/assets/js/jquery.themeegg.media.js', array( 'jquery' ), '3.1.0', false );
	}

	function require_files() {

		require_once( get_template_directory() . '/pro/widgets/class-eggnews-pro-widget-weather.php' );
		require_once( get_template_directory() . '/pro/widgets/class-eggnews-pro-widget-googlemap.php' );
		require_once( get_template_directory() . '/pro/widgets/class-eggnews-pro-currency-converter.php' );
		require_once( get_template_directory() . '/pro/widgets/class-eggnews-pro-call-to-action.php' );
		require_once( get_template_directory() . '/pro/widgets/class-eggnews-pro-current-date-time.php' );
		require_once( get_template_directory() . '/pro/widgets/class-eggnews-pro-youtube-playlist.php' );
		require_once( get_template_directory() . '/pro/widgets/class-eggnews-breaking-news.php' );
		require_once( get_template_directory() . '/pro/widgets/class-eggnews-125x125-advertisement.php' );
	}

	function widgets_init() {

		register_widget( 'Eggnews_Weather_Widget' );
		register_widget( 'Eggnews_Googlemap_Widget' );
		register_widget( 'Eggnews_Currency_Converter' );
		register_widget( 'Eggnews_Call_To_Action' );
		register_widget( 'Eggnews_Current_Date_Time' );
		register_widget( 'Eggnews_Youtube_Playlist' );
		register_widget( 'Eggnews_Breaking_News' );
		register_widget( 'Eggnews_125x125_Advertisement' );
	}

	function hooks_filters() {
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	function __destruct() {

	}
}

new Eggnews_Pro_Widgets();
