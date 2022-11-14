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
define( 'DB_NAME', 'tmdt' );

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
define( 'AUTH_KEY',         'JCpk;F2<=%sn7,ixAOso&<TSh7wQ!34OExF$hrra_/=G?l=B(SdP3/5Djzb<<Lru' );
define( 'SECURE_AUTH_KEY',  'HA`>FGO{ow :aY#zcI34j>OGEH, ?x$v.96OPf*|F$/6iw_+:I55P/s i>l;9W}-' );
define( 'LOGGED_IN_KEY',    '${H/uL#59?u)fidt=QQlOt?e Av[-I!D;p?@%.^[J9i%nx{OHg,+5RTCKNnUJG%3' );
define( 'NONCE_KEY',        ';JfG2(DO,%.8bP^j1#+c*`*t8hcbK-]96vUF#P[4#WI-!RmIom8cTA3iZ9]qK})_' );
define( 'AUTH_SALT',        'Rb`@FQc]De@Tc~;ZvAUt!r~4x7fLcVv)_m(x.:>W<U4lwD]L=Mq%<M,g)UDdBE7z' );
define( 'SECURE_AUTH_SALT', '=OA2t}yB~ cmkkS]TBRPq0(x}}|zWxPNL$nRJF[_#$I(YXMN-a#;P0_A^Bz*9l` ' );
define( 'LOGGED_IN_SALT',   'H5CJq}q+MXJ}%O>Z@4>w2%]wR{*EBk0yt_xxG:iZR8WK&{i<0z&U_wxT4{_2]f$@' );
define( 'NONCE_SALT',       'x:<B(@aZA%wg2pdVY!&>zo{J{onktewsAOi.5zXdKYUa7hsC:P2PL?FWz,ieIlgu' );

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
set_time_limit(300);


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
