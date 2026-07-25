<?php
/**
 * Election Terms Repository.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Repository;

defined( 'ABSPATH' ) || exit;

/**
 * Repository for election terms.
 */
final class ElectionTermsRepository extends AbstractRepository {

	/**
	 * Get table name.
	 *
	 * @return string
	 */
	protected function get_table_name(): string {

		global $wpdb;

		return $wpdb->prefix . 'mpcaa_election_terms';
	}

	/**
	 * Find election term by name.
	 *
	 * @param string $name Election term name.
	 * @return array|null
	 */
	public function find_by_name( string $name ): ?array {

		$sql = $this->wpdb->prepare(
			"SELECT *
			 FROM {$this->table}
			 WHERE term_name = %s
			 LIMIT 1",
			$name
		);

		$row = $this->wpdb->get_row( $sql, ARRAY_A );

		return is_array( $row ) ? $row : null;
	}

	/**
	 * Get current election term.
	 *
	 * @return array|null
	 */
	public function get_current(): ?array {

		$sql = "SELECT *
				FROM {$this->table}
				WHERE is_current = 1
				LIMIT 1";

		$row = $this->wpdb->get_row( $sql, ARRAY_A );

		return is_array( $row ) ? $row : null;
	}

	/**
	 * Get active election terms.
	 *
	 * @return array
	 */
	public function get_active(): array {

		$sql = "SELECT *
				FROM {$this->table}
				WHERE status = 'active'
				ORDER BY start_date DESC";

		$result = $this->wpdb->get_results( $sql, ARRAY_A );

		return is_array( $result ) ? $result : array();
	}

	/**
	 * Search election terms.
	 *
	 * @param string $keyword Search keyword.
	 * @return array
	 */
	public function search( string $keyword ): array {

		$like = '%' . $this->wpdb->esc_like( $keyword ) . '%';

		$sql = $this->wpdb->prepare(
			"SELECT *
			 FROM {$this->table}
			 WHERE
				term_name LIKE %s
				OR description LIKE %s
			 ORDER BY start_date DESC",
			$like,
			$like
		);

		$result = $this->wpdb->get_results( $sql, ARRAY_A );

		return is_array( $result ) ? $result : array();
	}

	/**
	 * Set current election term.
	 *
	 * @param int $id Election term ID.
	 * @return bool
	 */
	public function set_current( int $id ): bool {

		$this->wpdb->update(
			$this->table,
			array(
				'is_current' => 0,
			),
			array(
				'is_current' => 1,
			),
			array( '%d' ),
			array( '%d' )
		);

		return false !== $this->wpdb->update(
			$this->table,
			array(
				'is_current' => 1,
			),
			array(
				'id' => $id,
			),
			array( '%d' ),
			array( '%d' )
		);
	}
}