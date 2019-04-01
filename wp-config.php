<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'wd_i(/vPs2nn4&)dp|/s>-@1t4B1V_|<tY*DY#xLDb{(t(K=n)c/4lnG%(P{:b;W' );
define( 'SECURE_AUTH_KEY',  'qa9=.@r{d$%E3%@ImAQI b0vdurwGajay[xPR#eMj{tutw)4X~PuK!)P 4lX0DA:' );
define( 'LOGGED_IN_KEY',    ';yVV3e?EXW:H8zi[ r{Yx=+RtLU[P/MNvXCB9O&x$}cvBxN3[9PjqElkzR)qe)Fw' );
define( 'NONCE_KEY',        '=Xu;SPCfQC]q$))>#,_}YJE&*9jM1W:BB$zN3~/e*<O~t4&Om^I#jEQP!VbJz/gB' );
define( 'AUTH_SALT',        'o,<?h4s!))HJUCJkuA@&NVi$8:~z0LJ529LhLz^{ frfmINxqQTV_@:<>c&uu43g' );
define( 'SECURE_AUTH_SALT', '0whRu~]y[jKv_;+P@HAoFD%3IN*?E/Fyp@kG9yM?[z&VGrK;O`bU2C!()>rPHuVA' );
define( 'LOGGED_IN_SALT',   'FghT)^Tfu*D)Hu9Od>%J{r(OP8:=6$>wv1?dh3V97Aqq LaZ~j{xTCFTf^*0Kh#h' );
define( 'NONCE_SALT',       'jy+c8b~ lMFgtmNmx|d$=b1/14~{7[)A6MT&(6X<E&{=BW*dFO(?YrH`A&kTH|k`' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
