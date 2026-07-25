<?php
/**
 * Abstract Repository.
 *
 * Base implementation for all repositories.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Repository;

defined( 'ABSPATH' ) || exit;

use MPCAAConnect\Contracts\RepositoryInterface;
use wpdb;

/**
 * Base repository implementation.
 */
abstract class AbstractRepository implements RepositoryInterface {

	/**
	 * WordPress database instance.
	 *
	 * @var wpdb
	 */
	protected wpdb $wpdb;

	/**
	 * Database table name.
	 *
	 * @var string
	 */
	protected string $table;

	/**
	 * Primary key column.
	 *
	 * @var string
	 */
	protected string $primary_key = 'id';

	/**
	 * Constructor.
	 */
	public function __construct() {
		global $wpdb;

		$this->wpdb = $wpdb;
		$this->table = $this->get_table_name();
	}

	/**
	 * Get the repository table name.
	 *
	 * @return string
	 */
	abstract protected function get_table_name(): string;

	/**
	 * {@inheritDoc}
	 */
	public function find( int $id ): ?array {

		$sql = $this->wpdb->prepare(
			"SELECT * FROM {$this->table} WHERE {$this->primary_key} = %d LIMIT 1",
			$id
		);

		$result = $this->wpdb->get_row( $sql, ARRAY_A );

		return is_array( $result ) ? $result : null;
	}

	/**
	 * {@inheritDoc}
	 */
	public function get( array $args = array() ): array {

		$defaults = array(
			'where'   => '1=1',
			'orderby' => $this->primary_key,
			'order'   => 'ASC',
			'limit'   => 100,
			'offset'  => 0,
		);

		$args = wp_parse_args( $args, $defaults );

		$sql = sprintf(
			'SELECT * FROM %1$s WHERE %2$s ORDER BY %3$s %4$s LIMIT %5$d OFFSET %6$d',
			$this->table,
			$args['where'],
			$args['orderby'],
			strtoupper( (string) $args['order'] ),
			(int) $args['limit'],
			(int) $args['offset']
		);

		$result = $this->wpdb->get_results( $sql, ARRAY_A );

		return is_array( $result ) ? $result : array();
	}

	/**
	 * {@inheritDoc}
	 */
	public function create( array $data ): int {

		$inserted = $this->wpdb->insert(
			$this->table,
			$data
		);

		if ( false === $inserted ) {
			return 0;
		}

		return (int) $this->wpdb->insert_id;
	}

	/**
	 * {@inheritDoc}
	 */
	public function update( int $id, array $data ): bool {

		$result = $this->wpdb->update(
			$this->table,
			$data,
			array(
				$this->primary_key => $id,
			)
		);

		return false !== $result;
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete( int $id ): bool {

		$result = $this->wpdb->delete(
			$this->table,
			array(
				$this->primary_key => $id,
			)
		);

		return false !== $result;
	}

	/**
	 * {@inheritDoc}
	 */
	public function exists( int $id ): bool {

		return null !== $this->find( $id );
	}

	/**
	 * {@inheritDoc}
	 */
	public function count( array $criteria = array() ): int {

		$where = '1=1';

		if ( isset( $criteria['where'] ) && '' !== $criteria['where'] ) {
			$where = (string) $criteria['where'];
		}

		$sql = "SELECT COUNT(*) FROM {$this->table} WHERE {$where}";

		return (int) $this->wpdb->get_var( $sql );
	}
}