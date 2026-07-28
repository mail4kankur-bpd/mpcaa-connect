<?php
/**
 * Membership Type Service.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Services;

defined( 'ABSPATH' ) || exit;

use MPCAAConnect\Repository\MembershipTypesRepository;

final class MembershipTypeService {

	/**
	 * Repository.
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
	 * Find membership type by code.
	 *
	 * @param string $code Membership type code.
	 * @return array|null
	 */
	public function find_by_code( string $code ): ?array {

		return $this->repository->find_by_code( $code );
	}

	/**
	 * Get active membership types.
	 *
	 * @return array
	 */
	public function get_active(): array {

		return $this->repository->get_active();
	}

	/**
	 * Get default membership type.
	 *
	 * @return array|null
	 */
	public function get_default(): ?array {

		return $this->repository->get_default();
	}

	/**
	 * Search membership types.
	 *
	 * @param string $keyword Search keyword.
	 * @return array
	 */
	public function search( string $keyword ): array {

		return $this->repository->search( $keyword );
	}

	/**
	 * Check whether membership code exists.
	 *
	 * @param string $code Membership code.
	 * @return bool
	 */
	public function code_exists( string $code ): bool {

		return $this->repository->code_exists( $code );
	}
}