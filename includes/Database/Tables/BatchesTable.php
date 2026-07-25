<?php
/**
 * Batches Database Table.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Database\Tables;

defined( 'ABSPATH' ) || exit;

/**
 * Alumni batches table.
 */
final class BatchesTable extends AbstractTable {

	/**
	 * Returns the table slug.
	 *
	 * @return string
	 */
	public function get_name(): string {
		return 'batches';
	}

	/**
	 * Returns the CREATE TABLE statement.
	 *
	 * @return string
	 */
	public function get_schema(): string {

		$table_name = $this->get_table_name();

		return "
		CREATE TABLE {$table_name} (
			id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
			batch_year SMALLINT UNSIGNED NOT NULL,
			name VARCHAR(100) NOT NULL,
			description TEXT NULL,
			is_active TINYINT(1) NOT NULL DEFAULT 1,
			created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
			updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
				ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY (id),
			UNIQUE KEY batch_year (batch_year),
			KEY is_active (is_active)
		) {$this->get_charset_collate()};
		";
	}
}