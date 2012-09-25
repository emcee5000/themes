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
define('DB_NAME', 'kickpoin_wrd3');

/** MySQL database username */
define('DB_USER', 'kickpoin_wrd3');

/** MySQL database password */
define('DB_PASSWORD', 'qHdXFsXqRN');

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
define('AUTH_KEY',         'poOWhKN2qbKptQ0O4fWN6kpuELdnlNOjuIsMmeenEYhAmsTv4F9SxMe0AsDFkaUt');
define('SECURE_AUTH_KEY',  'L2wALXFPTpBYmg4K0iarEvFSejY9z5AWKSV2A7nNG0HwPUpjgbWfNbblibN67EvI');
define('LOGGED_IN_KEY',    'WEbvEg24m6ERyZdbfGtWeWMfJ5zNL7xZN2TCnNkBDEfu3UWoUuV2FpoPzQrJgKXT');
define('NONCE_KEY',        'dg5ecXpoGNcsAaPF1fWRGclCngey6Dg5TejDPnDT0wLvzZ7KzUhjeDLbRxtDzwDm');
define('AUTH_SALT',        'SdFeQWbuiF31Hn1LyuXvj8bd0A4GEM2pu12CpJ1pghmEUKWzBToPzShjXOrmhV1K');
define('SECURE_AUTH_SALT', 'p7R9cCkyr5EwsicdXGOareOWonVmGOP623s506zf8ziZyBPYvW9QPMcnBXLVDRTP');
define('LOGGED_IN_SALT',   'JHxOAvxiDGN9RMHRAClRTrBpjEkeUCj7VRnhSdCTAxjS4GVG5OzBDoCpF7CvhCaG');
define('NONCE_SALT',       'y9nlB3LMAJsWTfpE4n7SN4pYLFfAvJKBE7DbLAzdihijBPHhsT3N7FvnA2A0rVbI');

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
