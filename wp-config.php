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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'pragmatic' );

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
define( 'AUTH_KEY',         '0Rhb-s*57?}R<V8J&zwPSDS  ~zTiv:J -,!=B0=h~u&a`tu-x*7trY83~p8$wf;' );
define( 'SECURE_AUTH_KEY',  'O2PMyr{z5<SO-4SIUXOwh6emyZa+*^Xh^z Dh}~me09%s9o.eTBXqQ;UJWNyosT(' );
define( 'LOGGED_IN_KEY',    'U7[5bC#f-tg,&^?Q+ZA{^@W}`)kf.W~`H>nw^.RNzn$0U53XzqG[U?(,P4&tjRzw' );
define( 'NONCE_KEY',        'atE`Be0mX;RbxSJ._)#%Q%U#_Mf2(boL5^8Q|f7H =~4LqT!OUs#3T1K;x_{,W<0' );
define( 'AUTH_SALT',        '(npm-|&<Xr|wH@y0;6fpT4lG^1h}X~Q3hm@Oy)+WALj7Z{t[~~MIp=7{:,V>Ul.#' );
define( 'SECURE_AUTH_SALT', '+`uWX9`qHv@N5*tXiWa+Vk>0|>.d~FA dC!+9CY)8W>%N_}*ZbRG1+?__HhsP7<C' );
define( 'LOGGED_IN_SALT',   'FlB9 jdU%hp1v jRT Amnm?/H[=vWj}Wi0i[l?Sz/)^suC3EqVMs,sx*lpj#~A21' );
define( 'NONCE_SALT',       '}@|M-PQO!dmRF{JMUm>*/YeyfU-oWA;_GF}nhPo8A1d;Z:82VaU<bzE(N.C+m[E ' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
