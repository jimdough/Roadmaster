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
define('DB_NAME', 'blog-roadmaster');

/** MySQL database username */
define('DB_USER', 'roadmaster');

/** MySQL database password */
define('DB_PASSWORD', '77#nrtuM#');

/** MySQL hostname */
define('DB_HOST', 'localhost:30697');

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
define('AUTH_KEY',         'W+^okEMN[F.sY?}qV=bnO.%eO$Dtmh{rk| K`uFHk<gi/[!@TF,Ue,*KGZ](#mS,');
define('SECURE_AUTH_KEY',  '*9>pmsn4xfg68Q;Av*Zm~Bkv,e>H9^MEnb;Rwd-mY9-y;.qWf#C@.)b%MGFs{%7:');
define('LOGGED_IN_KEY',    'R/~kS`dE_:w)#DHbuQ46jmll1SM^3@KPKn Pj^(#hQjr}z&ZTrl[L;BliRC}{)8/');
define('NONCE_KEY',        'Fn DpOrY5PiR|aZI8pWC(P?NFfc#4`T1(Ks?;B8qpv|y )c)mAzIe.46~bWm{FqQ');
define('AUTH_SALT',        'eDJ4=znql-Li@:-EKKE5%4<qi0J,WA]^vg|KkI7%o1G>1pY2p%FHCb2Vv8[|7kGx');
define('SECURE_AUTH_SALT', ';c&yQ9kOcp?M~jW9>JgvC%LZ-vvlVR&OXtkuRU?C;V=*-x0$^``+rCK+m46t^st!');
define('LOGGED_IN_SALT',   'sY:f $j7~d26Ff8q`n_?h@Cka5(n]o14,MVzX@dO^<^NRe!q[Ic~c6)X:UAIv#tV');
define('NONCE_SALT',       'Xa9!Po7LW1/h}zi>R`>M+T:T)ibrg[k_t[!|F7q0kb br;Z9mig`^&q+h46j&Kw~');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
