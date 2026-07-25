<?php
/**
 * Membership Types Repository.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Repository;

defined( 'ABSPATH' ) || exit;

/**
 * Repository for membership types.
 */
final class MembershipTypesRepository extends AbstractRepository {

	/**
	 * Get table name.
	 *
	 * @return string
	 */
	protected function get_table_name(): string {

		global $wpdb;

		return $wpdb->prefix . 'mpcaa_membership_types';
	}

	/**
	 * Find by code.
	 *
	 * @param string $code Membership code.
	 * @return array|null
	 */
	public function find_by_code( string $code ): ?array {

		$sql = $this->wpdb->prepare(
			"SELECT * FROM {$this->table}
			WHERE code=%s
			LIMIT 1",
			$code
		);

		$row = $this->wpdb->get_row( $sql, ARRAY_A );

		return is_array( $row ) ? $row : null;
	}

	/**
	 * Get active membership types.
	 *
	 * @return array
	 */
	public function get_active(): array {

		$sql = "SELECT *
				FROM {$this->table}
				WHERE status='active'
				ORDER BY sort_order ASC,name ASC";

		$result = $this->wpdb->get_results( $sql, ARRAY_A );

		return is_array( $result ) ? $result : array();
	}

	/**
	 * Get default membership type.
	 *
	 * @return array|null
	 */
	public function get_default(): ?array {

		$sql = "SELECT *
				FROM {$this->table}
				WHERE is_default=1
				LIMIT 1";

		$row = $this->wpdb->get_row( $sql, ARRAY_A );

		return is_array( $row ) ? $row : null;
	}

	/**
	 * Search membership types.
	 *
	 * @param string $keyword Search text.
	 * @return array
	 */
	public function search( string $keyword ): array {

		$like = '%' . $this->wpdb->esc_like( $keyword ) . '%';

		$sql = $this->wpdb->prepare(
			"SELECT *
			FROM {$this->table}
			WHERE
				name LIKE %s
				OR code LIKE %s
				OR description LIKE %s
			ORDER BY sort_order ASC,name ASC",
			$like,
			$like,
			$like
		);

		$result = $this->wpdb->get_results( $sql, ARRAY_A );

		return is_array( $result ) ? $result : array();
	}

	/**
	 * Check whether a code already exists.
	 *
	 * @param string $code Membership code.
	 * @return bool
	 */
	public function code_exists( string $code ): bool {

		return null !== $this->find_by_code( $code );
	}
}