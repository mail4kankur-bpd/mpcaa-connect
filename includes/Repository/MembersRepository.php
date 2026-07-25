<?php
/**
 * Members Repository.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Repository;

defined( 'ABSPATH' ) || exit;

/**
 * Repository for the members table.
 */
final class MembersRepository extends AbstractRepository {

	/**
	 * Table name.
	 *
	 * @return string
	 */
	protected function get_table_name(): string {

		global $wpdb;

		return $wpdb->prefix . 'mpcaa_members';
	}

	/**
	 * Find member by Member ID.
	 *
	 * @param string $member_id Member ID.
	 * @return array|null
	 */
	public function find_by_member_id( string $member_id ): ?array {

		$sql = $this->wpdb->prepare(
			"SELECT * FROM {$this->table} WHERE member_id = %s LIMIT 1",
			$member_id
		);

		$result = $this->wpdb->get_row( $sql, ARRAY_A );

		return is_array( $result ) ? $result : null;
	}

	/**
	 * Find member by email.
	 *
	 * @param string $email Email.
	 * @return array|null
	 */
	public function find_by_email( string $email ): ?array {

		$sql = $this->wpdb->prepare(
			"SELECT * FROM {$this->table} WHERE email = %s LIMIT 1",
			$email
		);

		$result = $this->wpdb->get_row( $sql, ARRAY_A );

		return is_array( $result ) ? $result : null;
	}

	/**
	 * Find member by phone.
	 *
	 * @param string $phone Phone number.
	 * @return array|null
	 */
	public function find_by_phone( string $phone ): ?array {

		$sql = $this->wpdb->prepare(
			"SELECT * FROM {$this->table} WHERE phone = %s LIMIT 1",
			$phone
		);

		$result = $this->wpdb->get_row( $sql, ARRAY_A );

		return is_array( $result ) ? $result : null;
	}

	/**
	 * Get members by batch.
	 *
	 * @param int $batch_id Batch ID.
	 * @return array
	 */
	public function find_by_batch( int $batch_id ): array {

		$sql = $this->wpdb->prepare(
			"SELECT * FROM {$this->table}
			WHERE batch_id = %d
			ORDER BY first_name ASC",
			$batch_id
		);

		$result = $this->wpdb->get_results( $sql, ARRAY_A );

		return is_array( $result ) ? $result : array();
	}

	/**
	 * Search members.
	 *
	 * @param string $keyword Search keyword.
	 * @param int    $limit   Result limit.
	 * @return array
	 */
	public function search( string $keyword, int $limit = 25 ): array {

		$like = '%' . $this->wpdb->esc_like( $keyword ) . '%';

		$sql = $this->wpdb->prepare(
			"SELECT *
			FROM {$this->table}
			WHERE
				member_id LIKE %s
				OR first_name LIKE %s
				OR last_name LIKE %s
				OR email LIKE %s
				OR phone LIKE %s
			ORDER BY first_name ASC
			LIMIT %d",
			$like,
			$like,
			$like,
			$like,
			$like,
			$limit
		);

		$result = $this->wpdb->get_results( $sql, ARRAY_A );

		return is_array( $result ) ? $result : array();
	}
}