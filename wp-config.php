<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'a301526108235047');

/** MySQL database username */
define('DB_USER', 'a301526108235047');

/** MySQL database password */
define('DB_PASSWORD', 'h8B#fUS6jQVoJ');

/** MySQL hostname */
define('DB_HOST', 'a301526108235047.db.4441573.hostedresource.com');

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
define('AUTH_KEY',         'a=CkpWOIF&sNAYExV8GO');
define('SECURE_AUTH_KEY',  'Qhfh%rdQmJ+v4Dvrk_U&');
define('LOGGED_IN_KEY',    'GHNp#76HVWIRYy!FhzYd');
define('NONCE_KEY',        'wrHt!$C&b(NB+!hcR2_C');
define('AUTH_SALT',        'X CynNtWMLSXShQ$9O$m');
define('SECURE_AUTH_SALT', 'NBwDX*WNJYYI*a8H7X(6');
define('LOGGED_IN_SALT',   'EjqHhQOCFBttM53gH&B%');
define('NONCE_SALT',       '$4h8TzGrBO)arDCx00Fb');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
