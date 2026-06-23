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

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'unipix_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '-yoE#.XcsV^9Y[0|nnw5#Gvxm)>ywtx6P*o,zIvzf?<I`kGBpYnlP+X qk({te(R' );
define( 'SECURE_AUTH_KEY',  '9+QL|L)Bm|]37 :| `1o,}5K4WeU`,~H?gAMjD1,}Gx%F19ndG*4c(`^Gucy_Ecy' );
define( 'LOGGED_IN_KEY',    'VIt.-t[u/UqI6v?)k25%O5i%{mu{_DNaa`#DHl*lIP2kk)F5LtbpXH5+s|&~i3y:' );
define( 'NONCE_KEY',        'Y>!b<M.%=F0e-A]U$mNbh@Iv9!&SrZ|E9q_GFp%u(L)&370EJ+qGVGc:j2q$q0[0' );
define( 'AUTH_SALT',        'l*`<(F/G)$ln4*a.vv<}yvvvw]t6./pn8|uK@^)|D9tUKku%4%m#[,IXe4vja#XL' );
define( 'SECURE_AUTH_SALT', 'Z/^/kx< jD|<7HB.+I8q2UY?fuL!x+Gqa^MetC/d@%$p(0x0?m#to2BrvZqv8FB7' );
define( 'LOGGED_IN_SALT',   '+`{lr3(1H$ME{rgd?s[j0}+.aMGoG<w)m+slHAH;(&tM!NWJ]`[xVS9Eix$}v&MD' );
define( 'NONCE_SALT',       'qI]7Q<xeO31E.B40}~KIH{8v=Ar&R4@8J7-T~cLUOt|Y.*0DK&JR^B+ot|-gCUz-' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
