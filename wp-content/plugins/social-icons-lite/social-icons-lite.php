<?php
/*
Plugin Name: Social Icons Lite
Plugin URI: https://wordpress.org/plugins/social-icons-lite/
Description: Lightweight social icons Widget for WordPress
Version: 1.0.3
Author: ThemeEgg
Author URI: http://themeegg.com
License: GPL3
License URI: http://www.gnu.org/licenses/gpl.html
Text Domain: social-icons-lite
*/

define( 'SIL_PLUGIN_FILE', __FILE__ );
define( 'SIL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'SIL_ABSPATH', dirname( __FILE__ ) . '/' );
define( 'SIL_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'SIL_VERSION', '1.0.3' );
define( 'SIL_INCLUDES_DIR', SIL_ABSPATH . 'includes' . '/' );


// Required files
require_once SIL_INCLUDES_DIR . 'functions-core.php';
require_once SIL_INCLUDES_DIR . 'class-social-icons-lite.php';
