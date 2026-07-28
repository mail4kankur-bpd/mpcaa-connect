<?php
/**
 * Batch Service.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Services;

defined( 'ABSPATH' ) || exit;

use MPCAAConnect\Repository\BatchesRepository;

final class BatchService {

	/**
	 * Repository.
	 *
	 * @var BatchesRepository
	 */
	private BatchesRepository $repository;

	/**
	 * Constructor.
	 *
	 * @param BatchesRepository|null $repository Repository instance.
	 */
	public function __construct( ?BatchesRepository $repository = null ) {
		$this->repository = $repository ?? new BatchesRepository();
	}

	/**
	 * Find batch by year.
	 *
	 * @param int $year Batch year.
	 * @return array|null
	 */
	public function find_by_year( int $year ): ?array {
		return $this->repository->find_by_year( $year );
	}

	/**
	 * Get all active batches.
	 *
	 * @return array
	 */
	public function get_active(): array {
		return $this->repository->get_active();
	}

	/**
	 * Get all batches.
	 *
	 * @return array
	 */
	public function get_all(): array {
		return $this->repository->get_all();
	}

	/**
	 * Search batches.
	 *
	 * @param string $keyword Search keyword.
	 * @return array
	 */
	public function search( string $keyword ): array {
		return $this->repository->search( $keyword );
	}
}