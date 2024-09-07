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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
const DB_NAME     = 'blocksygaudevxyz_ZTMwMWQ5Njg5OWZmOT_dbname';
const DB_USER     = 'blocksygaudevxyz_ZTMwMWQ5Njg5OWZmOT_username';
const DB_PASSWORD = 'ZTMwMWQ5Njg5OWZmOTg2Yjg0ODk0NThkMjM3';

const DB_HOST    = 'localhost';
const DB_CHARSET = 'utf8mb4';
const DB_COLLATE = 'utf8mb4_unicode_520_ci';

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
define( 'AUTH_KEY',          '@+RBj;)I%`b>~`{oB9MVbjYaoy+sGK=,[.zN{Wd3@iP@=BcIH.fG`Rj7;jm1@nh<' );
define( 'SECURE_AUTH_KEY',   ';kh[~*I;<3m?)VRg80rX+7)R)b3=h&aL03Gy._IdXCYL/xmm7ac[4P61/bX:,qma' );
define( 'LOGGED_IN_KEY',     '[#+$BO]v&(QNW!fd>})J$*U$Pm_Q78c%Bt~jJ1&-X@w*#Z+{p4&t8N`E>>XO_+-t' );
define( 'NONCE_KEY',         'R2BA%a.VE<gE?&#hba&.c->90g`)x1RGM}:cNTNSW.k~NHyE:U0(x{ub5./qZ1od' );
define( 'AUTH_SALT',         '~i`u_}<1vWrA4R}tE*)mtK~ZD~(NOdfR*Ka)6:MIK9KC~?#b 6D-(r0)xMVNWyJI' );
define( 'SECURE_AUTH_SALT',  'o@z6-Ua$g^u*i#>Ak3B-Z&3|?HUMuk&P~4vYeq+!q&iz):jD>0T(V!-p &*a(hPy' );
define( 'LOGGED_IN_SALT',    'K!&!]$IKNa91v-Zx@:#8z(=:y:=^H?/|R^4C]ywu+n1NH1NXc698x=m]^{~t&nQe' );
define( 'NONCE_SALT',        'eF]/Q-nP]Yv^6qDgk&%Vj2^e%*KmqNSgG/e_giY`6 d8Ps5^k?a;&_b-`#d9$k/?' );
define( 'WP_CACHE_KEY_SALT', 'VTT#+CBD V/8Z77FHTB6:Li>doF2.9_,=EEkQ:?A]x1B7bdB8us_A[}w1wl{QbK`' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'YTVkOW_';

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
const WP_DEBUG         = true;
const WP_DEBUG_LOG     = true;
const WP_DEBUG_DISPLAY = false;

/* Add any custom values between this line and the "stop editing" line. */

//if ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ) {
//	@ini_set( 'session.cookie_secure', '1' );
//}

const TRACKING = false;
//if ( ! defined( 'FS_METHOD' ) ) {
//	define( 'FS_METHOD', 'direct' );
//}

/** PHP Memory */
const WP_MEMORY_LIMIT     = '512M';
const WP_MAX_MEMORY_LIMIT = '512M';

const DISALLOW_FILE_EDIT = true;
const DISALLOW_FILE_MODS = false;

/* SSL */
const FORCE_SSL_LOGIN = true;
const FORCE_SSL_ADMIN = true;

const WP_POST_REVISIONS = 2;
const EMPTY_TRASH_DAYS  = 15;
const AUTOSAVE_INTERVAL = 120;

/** WordPress core auto-update, */
const WP_AUTO_UPDATE_CORE = true;

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
