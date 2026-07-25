<?php
/**
 * Admin menu.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Admin;

defined( 'ABSPATH' ) || exit;

final class Menu {

	public const SLUG = 'mpcaa-connect';

	/**
	 * Register admin menu.
	 *
	 * @return void
	 */
	public function register(): void {

		add_menu_page(
			__( 'MPCAA Connect', 'mpcaa-connect' ),
			__( 'MPCAA Connect', 'mpcaa-connect' ),
			'manage_options',
			self::SLUG,
			array(
				new Dashboard(),
				'render',
			),
			'dashicons-groups',
			25
		);
	}
}