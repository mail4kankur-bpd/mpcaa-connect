<?php
/**
 * Membership Service.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Services;

defined( 'ABSPATH' ) || exit;

use MPCAAConnect\Repository\MembershipTypesRepository;

/**
 * Membership Service.
 */
final class MembershipService {

	/**
	 * Repository instance.
	 *
	 * @var MembershipTypesRepository
	 */
	private MembershipTypesRepository $repository;

	/**
	 * Constructor.
	 *
	 * @param MembershipTypesRepository|null $repository Repository instance.
	 */
	public function __construct( ?MembershipTypesRepository $repository = null ) {

		$this->repository = $repository ?? new MembershipTypesRepository();
	}

	/**
	 * Get all membership types.
	 *
	 * @return array
	 */
	public function all(): array {

		return $this->repository->all();
	}

	/**
	 * Find a membership type.
	 *
	 * @param int $id Membership type ID.
	 * @return array|null
	 */
	public function find( int $id ): ?array {

		return $this->repository->find( $id );
	}

	/**
	 * Create a membership type.
	 *
	 * @param array $data Membership type data.
	 * @return int
	 */
	public function create( array $data ): int {

		return $this->repository->create( $data );
	}

	/**
	 * Update a membership type.
	 *
	 * @param int   $id Membership type ID.
	 * @param array $data Membership type data.
	 * @return bool
	 */
	public function update( int $id, array $data ): bool {

		return $this->repository->update( $id, $data );
	}

	/**
	 * Delete a membership type.
	 *
	 * @param int $id Membership type ID.
	 * @return bool
	 */
	public function delete( int $id ): bool {

		return $this->repository->delete( $id );
	}
}
