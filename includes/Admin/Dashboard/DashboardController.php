<?php
/**
 * Dashboard Controller
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Admin\Dashboard;

defined( 'ABSPATH' ) || exit;

final class DashboardController {

	private WidgetManager $widgets;

	public function __construct() {

		$this->widgets = new WidgetManager();
	}

	public function widgets(): WidgetManager {

		return $this->widgets;
	}
}