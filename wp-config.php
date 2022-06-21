<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp-wla-test' );

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
define( 'AUTH_KEY',         'n_HfsQ1vz?fPX%kGOQtM&6Hf]U%yf!qc?D:K+-=#0:=C~=TJ51/j)_RDnXBQ NYU' );
define( 'SECURE_AUTH_KEY',  'XS?|_[gaHaFF/53zgt5iNzSQr}72cz:aC`fb;/hpnLAyMNEP#-OoGE(f2t.*fP4~' );
define( 'LOGGED_IN_KEY',    'w8,SCd[Qz+qsqa(MgVS8HgqX8YvR<[a4+|yv!@SHNu3=_Q.Vr]I=AuY(r*: <{nn' );
define( 'NONCE_KEY',        '$S<Vece>b.SYQZ!j/uCI}Ca7+WHI~S&&Ztd.yA#KVi4-w8L^Nz_Ivt!Pyj-?K`l^' );
define( 'AUTH_SALT',        'Lk%MP-yb9Y{7o>jSvL`%*U%<_fIBt-7MC_GMoikjO~h %R+o]Aa-3b+?M*~je@fh' );
define( 'SECURE_AUTH_SALT', 'DZ(Dn:jrfipzTu2GxE.?[^M>[<ENXDb~0jyI`9<f5/_0^{kLCMG<rXSKL?C{:;CV' );
define( 'LOGGED_IN_SALT',   '&]0nLDaj (8sB,xKl~9T9am]e1Vic/t!7s{P@;cu>Ul}{]D<@|Hq}Ic , ^-P`R=' );
define( 'NONCE_SALT',       'ZSVM0!{a{POXZts-_@iw/14x4Efe0[2ysEMk<j!*)xmgC2r_+ s;)/!M)>`k>7qy' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
