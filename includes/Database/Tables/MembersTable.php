<?php
/**
 * Members Database Table.
 *
 * Stores MPCAA alumni member records.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Database\Tables;

defined( 'ABSPATH' ) || exit;

/**
 * Members table.
 */
final class MembersTable extends AbstractTable {

	/**
	 * Table name.
	 *
	 * @return string
	 */
	public function get_name(): string {

		return 'members';
	}

	/**
	 * Database schema.
	 *
	 * @return string
	 */
	public function get_schema(): string {

		$table_name = $this->get_table_name();

		return "CREATE TABLE {$table_name} (
			id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

			member_id VARCHAR(20) NOT NULL,

			first_name VARCHAR(100) NOT NULL,

			last_name VARCHAR(100) DEFAULT '',

			email VARCHAR(190) DEFAULT '',

			phone VARCHAR(30) DEFAULT '',

			batch_id BIGINT UNSIGNED NOT NULL,

			membership_type_id BIGINT UNSIGNED DEFAULT NULL,

			graduation_year SMALLINT UNSIGNED NOT NULL,

			registration_status VARCHAR(30) NOT NULL DEFAULT 'pending',

			verification_status VARCHAR(30) NOT NULL DEFAULT 'pending',

			is_active TINYINT(1) NOT NULL DEFAULT 1,

			created_at DATETIME NOT NULL,

			updated_at DATETIME NOT NULL,

			PRIMARY KEY  (id),

			UNIQUE KEY member_id (member_id),

			KEY email (email),

			KEY phone (phone),

			KEY batch_id (batch_id),

			KEY membership_type_id (membership_type_id),

			KEY graduation_year (graduation_year),

			KEY registration_status (registration_status),

			KEY verification_status (verification_status)

		) {$this->get_charset_collate()};";
	}
}