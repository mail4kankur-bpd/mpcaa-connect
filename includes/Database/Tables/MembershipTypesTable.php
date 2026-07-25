<?php
/**
 * Membership Types Database Table.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Database\Tables;

defined( 'ABSPATH' ) || exit;

/**
 * Membership types lookup table.
 */
final class MembershipTypesTable extends AbstractTable {

	/**
	 * Returns the table slug.
	 *
	 * @return string
	 */
	public function get_name(): string {
		return 'membership_types';
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
			code VARCHAR(30) NOT NULL,
			name VARCHAR(100) NOT NULL,
			description TEXT NULL,
			is_active TINYINT(1) NOT NULL DEFAULT 1,
			sort_order SMALLINT UNSIGNED NOT NULL DEFAULT 0,
			created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
			updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
				ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY (id),
			UNIQUE KEY code (code),
			UNIQUE KEY name (name),
			KEY is_active (is_active),
			KEY sort_order (sort_order)
		) {$this->get_charset_collate()};
		";
	}
}