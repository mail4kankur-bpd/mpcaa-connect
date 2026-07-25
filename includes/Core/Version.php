<?php
/**
 * Plugin Version Information.
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Core;

defined( 'ABSPATH' ) || exit;

/**
 * Stores plugin version information.
 */
final class Version {

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	public const PLUGIN_VERSION = '0.1.0-alpha1';

	/**
	 * Plugin version alias.
	 *
	 * @var string
	 */
	public const VERSION = self::PLUGIN_VERSION;

	/**
	 * Database schema version.
	 *
	 * @var string
	 */
	public const DB_VERSION = '1.0.0';

	/**
	 * Prevent object creation.
	 */
	private function __construct() {
	}
}