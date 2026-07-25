<?php
/**
 * Abstract Database Table.
 *
 * Provides the base implementation for all MPCAA Connect
 * database tables.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Database\Tables;

use wpdb;

defined( 'ABSPATH' ) || exit;

/**
 * Base database table.
 */
abstract class AbstractTable {

	/**
	 * WordPress database instance.
	 *
	 * @var wpdb
	 */
	protected wpdb $wpdb;

	/**
	 * Constructor.
	 *
	 * @param wpdb $wpdb WordPress database object.
	 */
	public function __construct( wpdb $wpdb ) {
		$this->wpdb = $wpdb;
	}

	/**
	 * Returns table slug.
	 *
	 * Example:
	 *
	 * members
	 * batches
	 * elections
	 *
	 * @return string
	 */
	abstract public function get_name(): string;

	/**
	 * Returns CREATE TABLE SQL.
	 *
	 * Must NOT include the dbDelta() call.
	 *
	 * @return string
	 */
	abstract public function get_schema(): string;

	/**
	 * Returns the full prefixed table name.
	 *
	 * Example:
	 *
	 * wp_mpcaa_members
	 *
	 * @return string
	 */
	public function get_table_name(): string {
		return $this->wpdb->prefix . 'mpcaa_' . $this->get_name();
	}

	/**
	 * Returns the site's charset and collation.
	 *
	 * @return string
	 */
	protected function get_charset_collate(): string {
		return $this->wpdb->get_charset_collate();
	}

	/**
	 * Returns whether the table exists.
	 *
	 * @return bool
	 */
	public function exists(): bool {

		$table_name = $this->get_table_name();

		$query = $this->wpdb->prepare(
			'SHOW TABLES LIKE %s',
			$table_name
		);

		if ( null === $query ) {
			return false;
		}

		$result = $this->wpdb->get_var( $query );

		return $result === $table_name;
	}

	/**
	 * Returns the current row count.
	 *
	 * @return int
	 */
	public function count(): int {

		$table_name = $this->get_table_name();

		$query = sprintf(
			'SELECT COUNT(*) FROM `%s`',
			esc_sql( $table_name )
		);

		$result = $this->wpdb->get_var( $query );

		return (int) $result;
	}

	/**
	 * Drops the table.
	 *
	 * Intended for uninstall routines.
	 *
	 * @return void
	 */
	public function drop(): void {

		$table_name = $this->get_table_name();

		$this->wpdb->query(
			sprintf(
				'DROP TABLE IF EXISTS `%s`',
				esc_sql( $table_name )
			)
		);
	}
}