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
define( 'DB_NAME', 'wonderluxe' );

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
define( 'AUTH_KEY',         ';K%ZW(/|TJT&g,qtzdWk/?7I<4_[7P![0vX@]L])5t=1=X?Cc#sBv^Fpb%37S}= ' );
define( 'SECURE_AUTH_KEY',  'fYE`u-*];pI}>6_dI.L=ad$;-71OG4C(t_&p-:Zc5g0Mf3Ik#CJ5g$yb2SRElDTF' );
define( 'LOGGED_IN_KEY',    ' =;a:S6NRx#;G8zUUM}C:es3<-|;n~q>y.L+(fL6Gn((m?u/NZCplr 58V0C:nC[' );
define( 'NONCE_KEY',        '|x#u]^GV;c%VtYZDvVa{_gg$8ORCx&as&o#g3nTQ[XlYP2z`qy)%+}p]^ksH!sot' );
define( 'AUTH_SALT',        'V0t+>GY.z{j+jx/lsl+B]]HdT,S!}y<Em=.Ydq|JDAn%k7MT>r4q|8=rE.zZ|uan' );
define( 'SECURE_AUTH_SALT', ':ieT=e$UsioHD4.DUMEBNcV;FU@`zT7vEGx`.D4BirKpw_058]_CW02=s5O;hJEL' );
define( 'LOGGED_IN_SALT',   'BHf` .3GB`Dt2G5~y>fh)4HL$%E,3$Wi%x|TMd=!/C}ZNh<0?(V-9OEoDYnqm+/N' );
define( 'NONCE_SALT',       'Anv0M>BrJW6H}HWsy*fr+Zt}8HrF!}`u5HOL|Dph ILo[r%DaaEZ9Rm22zDW09#)' );

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
