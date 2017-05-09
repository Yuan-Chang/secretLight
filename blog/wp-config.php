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
define('DB_NAME', 'light');

/** MySQL database username */
define('DB_USER', 'maggie');

/** MySQL database password */
define('DB_PASSWORD', 'worldpeace');

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
define('AUTH_KEY',         'Q?w(pbn69Go91^}zGnu|GF?OUD7Gtl(y:&NF7-R|X_<??#bm-l:WU).p5]6-(-tv');
define('SECURE_AUTH_KEY',  ' l2Ag1+#1(UO-s)K|,VPkcZLWz,x(OF$kE8,v!{VkP_a6Aq~fTk!8gc e,sx7ra>');
define('LOGGED_IN_KEY',    '8XT_-p(q^iL/]RTrT`<$>m@|YoYCRAD?p{|jukZ= (HEAg}S@Xd!-|N8#-{?1-c.');
define('NONCE_KEY',        'v|r#bhhMOYY:+v(>4}D*I {BJN?kqz[Z7$.V&N-pmUeA}UgT@dc,ibRi}L*HQgnI');
define('AUTH_SALT',        'fYkr?(n/z;cwy+7xpulUka9XH<K-V-#|QTXI]|rL;2-xs}r!ekzBa+hhx9rB3{#b');
define('SECURE_AUTH_SALT', '?u}I74WQ*@p@{NmSfErKoYbz(MF=6C<6_%YIh0qYusloaEL2A)4##&fB7B}Bdv(o');
define('LOGGED_IN_SALT',   'WCu?!m_O4/peUm&[X0#&kE)8|=7`zvjw01gQ!x.+i(sp{T,Lzra.O;Gfh>z{c96z');
define('NONCE_SALT',       'iZnL0y2=B-~BQ{uK2d)+P,HsrFkDN`t+qc:+AL8&7Yz;8eupG)VWJ^Wa0&%ji4H%');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
