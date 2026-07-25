<?php
/**
 * Plugin Name: MPCAA Connect
 * Plugin URI: https://mpcaa.org
 * Description: Commercial Alumni Management System for MPCAA.
 * Version: 0.1.0-alpha1
 * Requires at least: 6.8
 * Requires PHP: 8.2
 * Author: MPCAA
 * License: GPL v2 or later
 * Text Domain: mpcaa-connect
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

defined( 'ABSPATH' ) || exit;

define( 'MPCAA_CONNECT_VERSION', '0.1.0-alpha1' );
define( 'MPCAA_CONNECT_PLUGIN_FILE', __FILE__ );
define( 'MPCAA_CONNECT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MPCAA_CONNECT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Simple PSR-4 autoloader.
 */
spl_autoload_register(
	static function ( string $class ): void {

		$prefix = 'MPCAAConnect\\';

		if ( strncmp( $class, $prefix, strlen( $prefix ) ) !== 0 ) {
			return;
		}

		$relative = substr( $class, strlen( $prefix ) );

		$file = MPCAA_CONNECT_PLUGIN_DIR .
			'includes/' .
			str_replace( '\\', DIRECTORY_SEPARATOR, $relative ) .
			'.php';

		if ( file_exists( $file ) ) {
			require_once $file;
		}
	}
);

/*
|--------------------------------------------------------------------------
| Plugin Activation
|--------------------------------------------------------------------------
*/

register_activation_hook(
	MPCAA_CONNECT_PLUGIN_FILE,
	array(
		\MPCAAConnect\Core\Activator::class,
		'activate',
	)
);

/*
|--------------------------------------------------------------------------
| Bootstrap Plugin
|--------------------------------------------------------------------------
*/

add_action(
	'plugins_loaded',
	static function (): void {

		if ( class_exists( \MPCAAConnect\Core\Plugin::class ) ) {
			\MPCAAConnect\Core\Plugin::instance()->run();
		}
	}
);