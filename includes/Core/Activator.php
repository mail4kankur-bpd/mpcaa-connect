<?php
/**
 * Plugin Activator.
 *
 * Runs all activation routines required by MPCAA Connect.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Core;

defined( 'ABSPATH' ) || exit;

use MPCAAConnect\Database\Installer;
use MPCAAConnect\Database\Migrator;

/**
 * Handles plugin activation.
 */
final class Activator {

	/**
	 * Activate the plugin.
	 *
	 * @return void
	 */
	public static function activate(): void {

		/*
		 * Create or update database tables.
		 */
		if ( class_exists( Installer::class ) ) {
			Installer::install();
		}

		/*
		 * Execute pending schema migrations.
		 */
		if ( class_exists( Migrator::class ) ) {
			Migrator::migrate();
		}

		/*
		 * Store current plugin version.
		 */
		update_option(
			'mpcaa_connect_version',
			Version::PLUGIN_VERSION
		);

		/*
		 * Store current database version.
		 */
		update_option(
			'mpcaa_connect_db_version',
			Version::DB_VERSION
		);

		/*
		 * Clear WordPress object cache.
		 */
		wp_cache_flush();
	}
}