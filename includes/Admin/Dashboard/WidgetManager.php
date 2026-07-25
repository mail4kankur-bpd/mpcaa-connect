<?php
/**
 * Widget Manager
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Admin\Dashboard;

defined( 'ABSPATH' ) || exit;

final class WidgetManager {

	/**
	 * @var WidgetInterface[]
	 */
	private array $widgets = array();

	public function register( WidgetInterface $widget ): void {
		$this->widgets[] = $widget;
	}

	/**
	 * @return WidgetInterface[]
	 */
	public function all(): array {
		return $this->widgets;
	}

	public function render(): void {

		foreach ( $this->widgets as $widget ) {

			echo '<div class="mpcaa-widget">';

			echo '<h2>' .
				esc_html( $widget->get_title() ) .
				'</h2>';

			$widget->render();

			echo '</div>';
		}
	}
}