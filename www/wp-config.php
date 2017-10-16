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
 *
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '4275152-1');
/** MySQL database username */
define('DB_USER', '4275152-1');
/** MySQL database password */
define('DB_PASSWORD', 'JbJdyeGz');
/** MySQL hostname */
define('DB_HOST', 'sql11.modules');
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
define('AUTH_KEY',         'GfkJ1INrQMzo+o8bKTUzfA');
define('SECURE_AUTH_KEY',  'M83phYNbj3062V2mt75eiQ');
define('LOGGED_IN_KEY',    'DzeI4PtAPL7kQ2uJwI7gjw');
define('NONCE_KEY',        'tTsJweQA68l3a2Yxu9G9Dw');
define('AUTH_SALT',        'lrxzlI0/kmLQr/cNBAXb/g');
define('SECURE_AUTH_SALT', '27tQK+48FZViKJd4UmNwIw');
define('LOGGED_IN_SALT',   'hb0/1VtqONtfe9mnwIMqAg');
define('NONCE_SALT',       'C92e2u3RXJYxuYop956Fwg');
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
define('WPLANG', 'fr_FR');
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
 //Added by WP-Cache Manager
define( 'WPCACHEHOME', ABSPATH.'/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
