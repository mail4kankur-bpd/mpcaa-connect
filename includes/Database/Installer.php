<?php
/**
 * Database Installer.
 *
 * Creates and updates the plugin database schema.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Database;

defined( 'ABSPATH' ) || exit;

/**
 * Handles installation of database tables.
 */
final class Installer {

	/**
	 * Install or update the database schema.
	 *
	 * @return void
	 */
	public static function install(): void {

		global $wpdb;

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		foreach ( Schema::get_schema( $wpdb ) as $sql ) {
			dbDelta( $sql );
		}
	}
}