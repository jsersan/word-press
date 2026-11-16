<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */


 define('WP_DEBUG', true);
 define('WP_DEBUG_LOG', true);
 define('WP_DEBUG_DISPLAY', false);
 define('WP_HOME', 'http://txemaserrano.com');
 define('WP_SITEURL', 'http://txemaserrano.com/wordpress');

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'qapf794' );

/** Database username */
define( 'DB_USER', 'qapf794' );

/** Database password */
define( 'DB_PASSWORD', 'Jss12aozMfmk2556#' );

/** Database hostname */
define( 'DB_HOST', 'qapf794.txemaserrano.com' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '1TYO[aONHGtTKgod[v{G^AhAc}|QWfw1UWKSeaahuX,%%ouR2ZvFBG>t3!=Mj4sm' );
define( 'SECURE_AUTH_KEY',  'l<thh-hJg1zE#6gQ6vQ:<G=pf(9K)b(#e}`UM!KC><9ZZb?VQ@G$eY~pCxB1KgE}' );
define( 'LOGGED_IN_KEY',    'xmrH,1n;m-=a0q`oHl{ TI(Z;}$^PJQ5S@>Xk{t%ji8Rmqnk[t24R);z/KwXGt+V' );
define( 'NONCE_KEY',        ',b24/[-Kk.ma]kPM<*XRAzoV<]$q<|(M5|%b[erJ~+4H9I=Jr&14On*.v(49L{xw' );
define( 'AUTH_SALT',        'tQ<LjHi3oiU#~td0zoebgQy$zb~o+$s#2ry_{b&gJE6Z`(+MI,|1~6DCmgJQR)%w' );
define( 'SECURE_AUTH_SALT', 'M#?,Ui }CR.*IFGV>zFoe? j4w^jpAg+=mn}THmd][&[k>06Lv}|G9VIfb++6.?z' );
define( 'LOGGED_IN_SALT',   'G2&3%!H*0-FBKlmUmU$%qi|~o{OPCbCueB98Viwnvn0ez<Dk$rqQ{]=*LnI0HZa ' );
define( 'NONCE_SALT',       '&@QT*60dq`ree-(PpM~Iiq6~JUA2IQn7e&b5zK36<p{5?u4)g4!Lf4]BdIZ,/tJV' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
// define( 'WP_DEBUG', false );

/* Forzar cookies para HTTP - AÑADIDO PARA SOLUCIONAR PROBLEMA DE LOGIN */
define('FORCE_SSL_ADMIN', false);
define('FORCE_SSL_LOGIN', false);
define('COOKIE_DOMAIN', false);
define('ADMIN_COOKIE_PATH', '/');
define('COOKIEPATH', '/');
define('SITECOOKIEPATH', '/');

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';