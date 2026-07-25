<?php
/**
 * Database Schema Manager.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Database;

use MPCAAConnect\Database\Tables\MembersTable;
use MPCAAConnect\Database\Tables\BatchesTable;
use MPCAAConnect\Database\Tables\MembershipTypesTable;
use MPCAAConnect\Database\Tables\FinancialYearsTable;
use MPCAAConnect\Database\Tables\ElectionTermsTable;
use wpdb;

defined( 'ABSPATH' ) || exit;

/**
 * Database schema provider.
 */
final class Schema {

	/**
	 * Returns database schemas.
	 *
	 * @param wpdb $wpdb WordPress database object.
	 *
	 * @return array<int,string>
	 */
	public static function get_schema( wpdb $wpdb ): array {

		$tables = array(
			new MembersTable( $wpdb ),
			new BatchesTable( $wpdb ),
			new MembershipTypesTable( $wpdb ),
			new FinancialYearsTable( $wpdb ),
			new ElectionTermsTable( $wpdb ),
		);

		$schemas = array();

		foreach ( $tables as $table ) {
			$schemas[] = $table->get_schema();
		}

		return $schemas;
	}
}