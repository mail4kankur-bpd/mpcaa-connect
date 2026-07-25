<?php
/**
 * Repository Interface.
 *
 * Defines the base contract for all repositories.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Contracts;

defined( 'ABSPATH' ) || exit;

/**
 * Base repository contract.
 */
interface RepositoryInterface {

	/**
	 * Find a record by primary key.
	 *
	 * @param int $id Record ID.
	 * @return array<string,mixed>|null
	 */
	public function find( int $id ): ?array;

	/**
	 * Retrieve records.
	 *
	 * Supported arguments may include:
	 * - where
	 * - orderby
	 * - order
	 * - limit
	 * - offset
	 *
	 * @param array<string,mixed> $args Query arguments.
	 * @return array<int,array<string,mixed>>
	 */
	public function get( array $args = array() ): array;

	/**
	 * Insert a record.
	 *
	 * @param array<string,mixed> $data Data.
	 * @return int Inserted record ID.
	 */
	public function create( array $data ): int;

	/**
	 * Update a record.
	 *
	 * @param int $id Record ID.
	 * @param array<string,mixed> $data Updated data.
	 * @return bool
	 */
	public function update( int $id, array $data ): bool;

	/**
	 * Delete a record.
	 *
	 * @param int $id Record ID.
	 * @return bool
	 */
	public function delete( int $id ): bool;

	/**
	 * Determine whether a record exists.
	 *
	 * @param int $id Record ID.
	 * @return bool
	 */
	public function exists( int $id ): bool;

	/**
	 * Count matching records.
	 *
	 * @param array<string,mixed> $criteria Query criteria.
	 * @return int
	 */
	public function count( array $criteria = array() ): int;
}