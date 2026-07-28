<?php
/**
 * Financial Year Service.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Services;

defined( 'ABSPATH' ) || exit;

use MPCAAConnect\Repository\FinancialYearsRepository;

final class FinancialYearService {

	/**
	 * Repository.
	 *
	 * @var FinancialYearsRepository
	 */
	private FinancialYearsRepository $repository;

	/**
	 * Constructor.
	 *
	 * @param FinancialYearsRepository|null $repository Repository instance.
	 */
	public function __construct( ?FinancialYearsRepository $repository = null ) {
		$this->repository = $repository ?? new FinancialYearsRepository();
	}

	/**
	 * Find financial year.
	 *
	 * @param string $year Financial year.
	 * @return array|null
	 */
	public function find_by_year( string $year ): ?array {
		return $this->repository->find_by_year( $year );
	}

	/**
	 * Get current financial year.
	 *
	 * @return array|null
	 */
	public function get_current(): ?array {
		return $this->repository->get_current();
	}

	/**
	 * Get active financial years.
	 *
	 * @return array
	 */
	public function get_active(): array {
		return $this->repository->get_active();
	}

	/**
	 * Search financial years.
	 *
	 * @param string $keyword Search keyword.
	 * @return array
	 */
	public function search( string $keyword ): array {
		return $this->repository->search( $keyword );
	}

	/**
	 * Set current financial year.
	 *
	 * @param int $id Financial year ID.
	 * @return bool
	 */
	public function set_current( int $id ): bool {
		return $this->repository->set_current( $id );
	}
}