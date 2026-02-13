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
define( 'DB_NAME', 'onboarding' );

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
define( 'AUTH_KEY',         'F>89Wp|]mf)=( &77-4,6|hCeeb$RAwO.QV=&hTr$vR#gumSC%Eh.kP{ro{*X5gt' );
define( 'SECURE_AUTH_KEY',  '{T3U[8BkGM]Zc!}m`mKtyG1wnYmyhVsU,/(3/v%Z*rRYp:G|wA.l8*O:}l5!:[>N' );
define( 'LOGGED_IN_KEY',    'Q :D^g!ap7DIUzm6Ws6{PMs>ZtK-!Z#sw9SrSQKFwjh? Bydp4FuKp1=#/_1(5c%' );
define( 'NONCE_KEY',        'K7:ynQtY%PR~H$g+4NfXq.4(eHWlPI1Wo*,9;]4AX<4N ,re1a5]1dqD]h.(}{C9' );
define( 'AUTH_SALT',        '+h0xwt9-x0~Mn_zJ703l<#~B3{e4xgOO&8|L&wscM7MwOtZF{K@$~V~>t^j9SD`r' );
define( 'SECURE_AUTH_SALT', 'mQcvJ$,hSdzNg!c$BE39lP+4?{} pKTOWaxRJ4b9UKG{?QU}S*Q[;etEb8l}TO0h' );
define( 'LOGGED_IN_SALT',   'yT+,LhZPn{DecN~bP&G&r ?*at]&i,Ye[WF$ubMxXqlw;9Mq(A+WRrIR~P!gQTYd' );
define( 'NONCE_SALT',       't~#[`8$6n7ObMoON]9B 0g{4;^|^e6Zla|GpAns%u|L_ggZS$}f]}YwDu%;=0nK!' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
define( 'WP_DEBUG', true );

define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
