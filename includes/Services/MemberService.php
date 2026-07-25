<?php
/**
 * Member Service.
 *
 * Business logic for members.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Services;

defined( 'ABSPATH' ) || exit;

use MPCAAConnect\Repository\MembersRepository;

/**
 * Member Service.
 */
final class MemberService {

	/**
	 * Members repository.
	 *
	 * @var MembersRepository
	 */
	private MembersRepository $repository;

	/**
	 * Constructor.
	 *
	 * @param MembersRepository|null $repository Repository instance.
	 */
	public function __construct( ?MembersRepository $repository = null ) {

		$this->repository = $repository ?? new MembersRepository();
	}

	/**
	 * Find member by database ID.
	 *
	 * @param int $id Member ID.
	 * @return array|null
	 */
	public function find( int $id ): ?array {

		return $this->repository->find( $id );
	}

	/**
	 * Find member by registration/member ID.
	 *
	 * @param string $member_id Member ID.
	 * @return array|null
	 */
	public function find_by_member_id( string $member_id ): ?array {

		return $this->repository->find_by_member_id( $member_id );
	}

	/**
	 * Find member by email.
	 *
	 * @param string $email Email.
	 * @return array|null
	 */
	public function find_by_email( string $email ): ?array {

		return $this->repository->find_by_email( $email );
	}

	/**
	 * Find member by phone.
	 *
	 * @param string $phone Phone.
	 * @return array|null
	 */
	public function find_by_phone( string $phone ): ?array {

		return $this->repository->find_by_phone( $phone );
	}

	/**
	 * Create member.
	 *
	 * @param array<string,mixed> $data Member data.
	 * @return int
	 */
	public function create( array $data ): int {

		return $this->repository->create( $data );
	}

	/**
	 * Update member.
	 *
	 * @param int                 $id Member ID.
	 * @param array<string,mixed> $data Member data.
	 * @return bool
	 */
	public function update( int $id, array $data ): bool {

		return $this->repository->update( $id, $data );
	}

	/**
	 * Delete member.
	 *
	 * @param int $id Member ID.
	 * @return bool
	 */
	public function delete( int $id ): bool {

		return $this->repository->delete( $id );
	}

	/**
	 * Get all members.
	 *
	 * @return array<int,array<string,mixed>>
	 */
	public function all(): array {

		return $this->repository->all();
	}
}
