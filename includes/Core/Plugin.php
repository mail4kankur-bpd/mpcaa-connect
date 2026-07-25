<?php
/**
 * Core Plugin Bootstrap.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Core;

defined( 'ABSPATH' ) || exit;

/**
 * Main plugin controller.
 */
final class Plugin {

	/**
	 * Singleton instance.
	 *
	 * @var Plugin|null
	 */
	private static ?Plugin $instance = null;

	/**
	 * Loader instance.
	 *
	 * @var Loader
	 */
	private Loader $loader;

	/**
	 * Configuration instance.
	 *
	 * @var Config
	 */
	private Config $config;

	/**
	 * Get singleton instance.
	 *
	 * @return Plugin
	 */
	public static function instance(): Plugin {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {

		$this->config = new Config();
		$this->loader = new Loader();

		if ( is_admin() ) {
		$admin = new \MPCAAConnect\Admin\Admin( $this->loader );
		$admin->register();
		}

		$this->register_hooks();
	}

	/**
	 * Prevent cloning.
	 *
	 * @return void
	 */
	private function __clone() {}

	/**
	 * Prevent unserialization.
	 *
	 * @throws \Exception Always.
	 * @return void
	 */
	public function __wakeup(): void {
		throw new \Exception( 'Cannot unserialize singleton.' );
	}

	/**
	 * Initialize plugin.
	 *
	 * @return void
	 */
	public function run(): void {

		/**
		 * Fires before MPCAA Connect starts.
		 */
		do_action( 'mpcaa_connect_before_run', $this );

		if ( method_exists( $this->loader, 'run' ) ) {
			$this->loader->run();
		}

		/**
		 * Fires after MPCAA Connect starts.
		 */
		do_action( 'mpcaa_connect_after_run', $this );
	}

	/**
	 * Register WordPress hooks.
	 *
	 * @return void
	 */
	private function register_hooks(): void {

		add_action(
			'init',
			function (): void {
				load_plugin_textdomain(
					'mpcaa-connect',
					false,
					dirname( plugin_basename( MPCAA_CONNECT_PLUGIN_FILE ) ) . '/languages'
				);
			}
		);

		add_action(
			'admin_init',
			function (): void {
				if ( ! current_user_can( 'manage_options' ) ) {
					return;
				}

				do_action( 'mpcaa_connect_admin_init' );
			}
		);

		add_action(
			'rest_api_init',
			function (): void {
				do_action( 'mpcaa_connect_register_rest_routes' );
			}
		);
	}

	/**
	 * Get loader.
	 *
	 * @return Loader
	 */
	public function get_loader(): Loader {
		return $this->loader;
	}

	/**
	 * Get configuration.
	 *
	 * @return Config
	 */
	public function get_config(): Config {
		return $this->config;
	}
}