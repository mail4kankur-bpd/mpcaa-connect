<?php
/**
 * Election Terms Database Table.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Database\Tables;

defined( 'ABSPATH' ) || exit;

/**
 * Election terms lookup table.
 */
final class ElectionTermsTable extends AbstractTable {

	/**
	 * Returns the table slug.
	 *
	 * @return string
	 */
	public function get_name(): string {
		return 'election_terms';
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
			name VARCHAR(100) NOT NULL,
			start_date DATE NOT NULL,
			end_date DATE NOT NULL,
			is_current TINYINT(1) NOT NULL DEFAULT 0,
			is_completed TINYINT(1) NOT NULL DEFAULT 0,
			description TEXT NULL,
			created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
			updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
				ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY (id),
			UNIQUE KEY term_period (start_date, end_date),
			KEY is_current (is_current),
			KEY is_completed (is_completed)
		) {$this->get_charset_collate()};
		";
	}
}