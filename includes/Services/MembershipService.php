<?php
/**
 * Member Service.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Services;

defined( 'ABSPATH' ) || exit;

use MPCAAConnect\Repository\MembersRepository;

final class MemberService {

	/**
	 * Repository.
	 *
	 * @var MembersRepository
	 */
	private MembersRepository $repository;

	public function __construct( ?MembersRepository $repository = null ) {

		$this->repository = $repository ?? new MembersRepository();
	}

	public function find( int $id ): ?array {

		return $this->repository->find( $id );
	}

	public function get( array $args = array() ): array {

		return $this->repository->get( $args );
	}

	public function find_by_member_id( string $member_id ): ?array {

		return $this->repository->find_by_member_id( $member_id );
	}

	public function find_by_email( string $email ): ?array {

		return $this->repository->find_by_email( $email );
	}

	public function find_by_phone( string $phone ): ?array {

		return $this->repository->find_by_phone( $phone );
	}

	public function find_by_batch( int $batch_id ): array {

		return $this->repository->find_by_batch( $batch_id );
	}

	public function search( string $keyword, int $limit = 25 ): array {

		return $this->repository->search( $keyword, $limit );
	}

	public function create( array $data ): int {

		return $this->repository->create( $data );
	}

	public function update( int $id, array $data ): bool {

		return $this->repository->update( $id, $data );
	}

	public function delete( int $id ): bool {

		return $this->repository->delete( $id );
	}

	public function exists( int $id ): bool {

		return $this->repository->exists( $id );
	}

	public function count( array $criteria = array() ): int {

		return $this->repository->count( $criteria );
	}
}
