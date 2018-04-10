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
define('DB_NAME', 'itga1');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '5&lv@-7^9hI 7Dm*v,-nOV~_#y`SXACzX7:u4S%qXw5uNux/n}GAj<=#zo]% $h.');
define('SECURE_AUTH_KEY',  'h([g6Dq?TmWk?)JGqG|Gk<&74/J=7c bsBjLwfO&]!3T)+=fvFv!Tc_IhgwhB:]u');
define('LOGGED_IN_KEY',    'w37t-*WSj*Q>epY:T!)eWl)W/#q{gC[,{vzjiZnijQHa9H%pssd{Q}(2Gxg{mh# ');
define('NONCE_KEY',        ',#NV%?>)`(]=6svE?=~MpHK#cEMP=Yp2v#CAKz$780A+Ev.=Nd0wdt-D(K|7}Idy');
define('AUTH_SALT',        'YI{oE3To^qN7LClg8=)FbJqm8=StAjWwf/R]lysq~@34Owxje$d9#NA[mMx1]e;7');
define('SECURE_AUTH_SALT', '7` ^Z[K4i[0&Q,4k|=IqQT;2%?siwgNfrK_6^%gk4tcz?fKQt&r!ff3edt$rUeTV');
define('LOGGED_IN_SALT',   'U%26KDB{])A)QAbu^B~nQ=/90!cL)AH9tM?~4)q|r0zj-d D])/+zGOI/f`cOD}&');
define('NONCE_SALT',       'vx2a?T:`[BGM>!M&mcoG%lMi)7scR-evYYyl3TC*l}qHy*OotoL2?;~J]U< cdT*');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'itga_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
