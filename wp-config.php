<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'apps');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'clinicol');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '}BaWu!zmzM.|n%I|p;Q>|<e}!IpGG}sNt}+{kRGb~geM$Fc{TW#mHi3{:`[m[Wt<');
define('SECURE_AUTH_KEY',  '5s<5KqyNdcgH84|ATv/bI*0:/wl43fUUt^S.0<=N*c{+ZPwnvur7,!z|}>?E  z`');
define('LOGGED_IN_KEY',    'e3EUsIxR!}!V>=Z@/*lOLn2[|}z/|mZu#g;;xZ]]n}r&O(b+>$Z@bG)z!V4pLR{w');
define('NONCE_KEY',        '`fB|x&o2KmK&:$F8b|uA J=W-7c9i{-EvGcP@Jf:4fG!SjLPvePMW<*v *]x6^f$');
define('AUTH_SALT',        '~}n!wZ`3`vpv,~E(LU<cV<8|j%A4fn8?)$~+}255w+s5,UfFXR<[ZZX>$ L6XS|-');
define('SECURE_AUTH_SALT', 'e92.R>B&4VX.,uHyu-]]%SE7-9g-6wOc&Ug)&3g=&G-||!WO_UF;hHDy/2n<.sR,');
define('LOGGED_IN_SALT',   '*LIiF*XIM#*lw^]HZ]S1zDd1vE GB)Lt3S]BN:wITFHt.5p/lW; !|v-nW]-J8t+');
define('NONCE_SALT',       '5[dRK#r;k@Ki~*/DsX]~UXYw[xoh.Y/7Y)x-IXbr<(D{+vtB}KZh_CL-d],0|Vvr');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

