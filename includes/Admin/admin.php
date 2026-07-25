<?php
/**
 * Admin bootstrap.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Admin;

use MPCAAConnect\Core\Loader;

defined( 'ABSPATH' ) || exit;

final class Admin {

	/**
	 * Loader.
	 *
	 * @var Loader
	 */
	private Loader $loader;

	/**
	 * Constructor.
	 *
	 * @param Loader $loader Loader instance.
	 */
	public function __construct( Loader $loader ) {

		$this->loader = $loader;
	}

	/**
	 * Register module.
	 *
	 * @return void
	 */
	public function register(): void {

		$menu = new Menu();

		$this->loader->add_action(
			'admin_menu',
			$menu,
			'register'
		);

		$this->loader->add_action(
			'admin_enqueue_scripts',
			$this,
			'enqueue_assets'
		);
	}

	/**
	 * Enqueue admin assets.
	 *
	 * @return void
	 */
	public function enqueue_assets(): void {

		$screen = get_current_screen();

		if ( ! $screen ) {
			return;
		}

		if ( 'toplevel_page_mpcaa-connect' !== $screen->id ) {
			return;
		}

		wp_enqueue_style(
			'mpcaa-connect-admin',
			MPCAA_CONNECT_PLUGIN_URL . 'assets/admin/css/admin.css',
			array(),
			MPCAA_CONNECT_VERSION
		);

		wp_enqueue_script(
			'mpcaa-connect-admin',
			MPCAA_CONNECT_PLUGIN_URL . 'assets/admin/js/admin.js',
			array(),
			MPCAA_CONNECT_VERSION,
			true
		);
	}
}