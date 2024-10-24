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
define( 'DB_NAME', 'portfolio' );

/** Database username */
define( 'DB_USER', 'Ronan-Lef' );

/** Database password */
define( 'DB_PASSWORD', 'Pswrd56781*' );

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
define( 'AUTH_KEY',         'DH?HMPv 2.9?/R+>T 5LTU_dJ]o1}&rr+EO0]$rQhu]ry$l{!,Z8xY1W7s.>h~mk' );
define( 'SECURE_AUTH_KEY',  'A<vD6^^uO</ a+F!Zl{KH4hmScl1T5 ?J1fKs2;0>3qw@r%sBg?w647PKio^!Wi^' );
define( 'LOGGED_IN_KEY',    '|,g?<H$TbJu:C<}V&(--,{yW/m;bh%bmG`YxJ*C9Z/ p&NN5%8A~ O+TUz3@=n*V' );
define( 'NONCE_KEY',        ',Q0Gqw:~(vQuGqSd:3(^y?r6M{K@5?0r&PQgAm^(OfD%LxOE]?teJ&f[i9(ef+oU' );
define( 'AUTH_SALT',        'xkj7g0RK14 MHMg0I#JY8Z<pVlhp9BBXF]3`ktio4VP^MVw5n6b#h*3aUwMEUcf*' );
define( 'SECURE_AUTH_SALT', ';(8SOK=qWO{q`7i_s(^=8vO]B|/J8-;3>OxAkV%[U$mgZGOk2c(-mU&+;$~qz.7-' );
define( 'LOGGED_IN_SALT',   'sBg(79Sg0p*nmb/g}oZIBrnf4zN!wM_]*;#c5QRn-<~aSr-jh69<0Fi7[OP3P`lC' );
define( 'NONCE_SALT',       '/LKKi3m[]S5aAA&%]j/s.#-qLfqApqG)Ppl3`fj8UA#~,{)x5>b9uLAG7~Sd)*>/' );

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
