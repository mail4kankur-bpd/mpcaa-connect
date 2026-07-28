<?php
/**
 * Election Service.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Services;

defined( 'ABSPATH' ) || exit;

use MPCAAConnect\Repository\ElectionTermsRepository;

final class ElectionService {

	/**
	 * Repository.
	 *
	 * @var ElectionTermsRepository
	 */
	private ElectionTermsRepository $repository;

	/**
	 * Constructor.
	 *
	 * @param ElectionTermsRepository|null $repository Repository instance.
	 */
	public function __construct( ?ElectionTermsRepository $repository = null ) {
		$this->repository = $repository ?? new ElectionTermsRepository();
	}

	/**
	 * Find election term by name.
	 *
	 * @param string $name Election term name.
	 * @return array|null
	 */
	public function find_by_name( string $name ): ?array {
		return $this->repository->find_by_name( $name );
	}

	/**
	 * Get current election term.
	 *
	 * @return array|null
	 */
	public function get_current(): ?array {
		return $this->repository->get_current();
	}

	/**
	 * Get active election terms.
	 *
	 * @return array
	 */
	public function get_active(): array {
		return $this->repository->get_active();
	}

	/**
	 * Search election terms.
	 *
	 * @param string $keyword Search keyword.
	 * @return array
	 */
	public function search( string $keyword ): array {
		return $this->repository->search( $keyword );
	}

	/**
	 * Set current election term.
	 *
	 * @param int $id Election term ID.
	 * @return bool
	 */
	public function set_current( int $id ): bool {
		return $this->repository->set_current( $id );
	}
}