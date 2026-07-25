<?php
/**
 * Database Migrator.
 *
 * Handles future database schema migrations.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Database;

defined( 'ABSPATH' ) || exit;

use MPCAAConnect\Core\Version;

/**
 * Handles database schema migrations.
 */
final class Migrator {

	/**
	 * Execute pending database migrations.
	 *
	 * @return void
	 */
	public static function migrate(): void {

		$current_version = (string) get_option(
			'mpcaa_connect_db_version',
			'0.0.0'
		);

		$target_version = Version::DB_VERSION;

		if ( version_compare( $current_version, $target_version, '>=' ) ) {
			return;
		}

		self::run_migrations( $current_version, $target_version );

		update_option(
			'mpcaa_connect_db_version',
			$target_version
		);
	}

	/**
	 * Run pending migrations.
	 *
	 * @param string $current_version Installed database version.
	 * @param string $target_version  Target database version.
	 *
	 * @return void
	 */
	private static function run_migrations(
		string $current_version,
		string $target_version
	): void {

		/*
		 * Future example:
		 *
		 * if ( version_compare( $current_version, '0.2.0', '<' ) ) {
		 *     self::migrate_to_020();
		 * }
		 *
		 * if ( version_compare( $current_version, '0.3.0', '<' ) ) {
		 *     self::migrate_to_030();
		 * }
		 */

		unset( $current_version, $target_version );
	}
}