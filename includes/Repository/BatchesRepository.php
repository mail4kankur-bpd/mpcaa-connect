<?php
/**
 * Batches Repository.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Repository;

defined( 'ABSPATH' ) || exit;

/**
 * Repository for batches table.
 */
final class BatchesRepository extends AbstractRepository {

	/**
	 * Get table name.
	 *
	 * @return string
	 */
	protected function get_table_name(): string {

		global $wpdb;

		return $wpdb->prefix . 'mpcaa_batches';
	}

	/**
	 * Find batch by year.
	 *
	 * @param int $year Batch year.
	 * @return array|null
	 */
	public function find_by_year( int $year ): ?array {

		$sql = $this->wpdb->prepare(
			"SELECT * FROM {$this->table} WHERE batch_year = %d LIMIT 1",
			$year
		);

		$result = $this->wpdb->get_row( $sql, ARRAY_A );

		return is_array( $result ) ? $result : null;
	}

	/**
	 * Get active batches.
	 *
	 * @return array
	 */
	public function get_active(): array {

		$sql = "SELECT * FROM {$this->table}
				WHERE status = 'active'
				ORDER BY batch_year DESC";

		$result = $this->wpdb->get_results( $sql, ARRAY_A );

		return is_array( $result ) ? $result : array();
	}

	/**
	 * Get all batches ordered by year.
	 *
	 * @return array
	 */
	public function get_all(): array {

		$sql = "SELECT * FROM {$this->table}
				ORDER BY batch_year DESC";

		$result = $this->wpdb->get_results( $sql, ARRAY_A );

		return is_array( $result ) ? $result : array();
	}

	/**
	 * Search batches.
	 *
	 * @param string $keyword Search keyword.
	 * @return array
	 */
	public function search( string $keyword ): array {

		$like = '%' . $this->wpdb->esc_like( $keyword ) . '%';

		$sql = $this->wpdb->prepare(
			"SELECT *
			 FROM {$this->table}
			 WHERE batch_year LIKE %s
			    OR batch_name LIKE %s
			 ORDER BY batch_year DESC",
			$like,
			$like
		);

		$result = $this->wpdb->get_results( $sql, ARRAY_A );

		return is_array( $result ) ? $result : array();
	}
}