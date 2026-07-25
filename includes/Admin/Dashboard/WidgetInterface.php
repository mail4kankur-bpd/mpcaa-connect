<?php
/**
 * Dashboard Widget Interface
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Admin\Dashboard;

defined( 'ABSPATH' ) || exit;

interface WidgetInterface {

	/**
	 * Widget identifier.
	 */
	public function get_id(): string;

	/**
	 * Widget title.
	 */
	public function get_title(): string;

	/**
	 * Render widget.
	 */
	public function render(): void;
}