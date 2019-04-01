<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if ( ! class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

$eggnews_pro = wp_get_theme();
$eggnews_pro_version = $eggnews_pro->get( 'Version' );
$eggnews_pro_version = !empty($eggnews_pro_version) ? $eggnews_pro_version : '1.0.0';

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

// Config settings
	$config = array(
		'remote_api_url' => 'https://themeegg.com', // Site where EDD is hosted
		'item_name'      => 'EggNews Pro WordPress Theme', // Name of theme
		'theme_slug'     => 'eggnews-pro-wordpress-theme', // Theme slug
		'version'        => $eggnews_pro_version, // The current version of this theme
		'author'         => 'ThemeEgg', // The author of this theme
		'download_id'    => '505', // Optional, used for generating a license renewal link
		'renew_url'      => '', // Optional, allows for a custom license renewal link
		'beta'           => false, // Optional, set to true to opt into beta versions
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Theme License', 'eggnews-pro' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'eggnews-pro' ),
		'license-key'               => __( 'License Key', 'eggnews-pro' ),
		'license-action'            => __( 'License Action', 'eggnews-pro' ),
		'deactivate-license'        => __( 'Deactivate License', 'eggnews-pro' ),
		'activate-license'          => __( 'Activate License', 'eggnews-pro' ),
		'status-unknown'            => __( 'License status is unknown.', 'eggnews-pro' ),
		'renew'                     => __( 'Renew?', 'eggnews-pro' ),
		'unlimited'                 => __( 'unlimited', 'eggnews-pro' ),
		'license-key-is-active'     => __( 'License key is active.', 'eggnews-pro' ),
		'expires%s'                 => __( 'Expires %s.', 'eggnews-pro' ),
		'expires-never'             => __( 'Lifetime License.', 'eggnews-pro' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'eggnews-pro' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'eggnews-pro' ),
		'license-key-expired'       => __( 'License key has expired.', 'eggnews-pro' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'eggnews-pro' ),
		'license-is-inactive'       => __( 'License is inactive.', 'eggnews-pro' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'eggnews-pro' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'eggnews-pro' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'eggnews-pro' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'eggnews-pro' ),
		'update-available'          => __( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'eggnews-pro' ),
	)

);
