<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wpn_test');

/** MySQL database username */
define('DB_USER', 'intellego_usr');

/** MySQL database password */
define('DB_PASSWORD', 'L3EqhBtjHeX3');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', 'utf8_general_ci');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^h8ME3-7cQG%b>faS&R%~51Z]%IIc[(ZMhxtTvINjf9*+9- j=V,~dUzB%b3ueÑZ');
define('SECURE_AUTH_KEY',  '@Pp}yU=$NM^%|bL7@Ñn#x|!W3|L/8[Rn nz;@/vn&i95F(<?KVo/]EL &!6qio`X');
define('LOGGED_IN_KEY',    'kv?B*QpP$mX+R)7Ag&[u^2n6}eLybm@7PL*T#<*qÑW/3Ws+m(d#9mYnb_5t1H+_l');
define('NONCE_KEY',        '>Dl;7Erz>Dm ~;/I~+ÑT?%%}}=X67R|]2:4l2r}ObKrKR|jYOhr]$$7idUPDkaZ8');
define('AUTH_SALT',        '/z7v}6dZq`kmSvK@r.j?62H~hÑD |=gg_-E3j*^ke+*crvb7jrb}`&Md=fk4D>*Y');
define('SECURE_AUTH_SALT', '6AT~omFz`c]4lzs%xÑRT:>23#p<:~K^NzlRlLzscQ;^.S2BB!@?){S8{c/aPI`]F');
define('NONCE_SALT',       '4Shjw|QF+4qdJ}p<wÑ,Q%/D5wRlJ Zc1I$>(z8vvET&Qc}E,?a+.*{AyTe*6_;mj');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpn0_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);

/**
 * Multisite
 */
define( 'WP_ALLOW_MULTISITE', true );
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', '162.243.26.40');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/**
 * Disable Post Revisions
 */
//define('WP_POST_REVISIONS', false);

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', 'es-MX');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
        define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
