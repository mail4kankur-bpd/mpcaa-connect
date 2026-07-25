<?php
/**
 * System Information Widget
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Admin\Dashboard;

defined( 'ABSPATH' ) || exit;

final class SystemInfoWidget extends AbstractWidget {

	public function get_id(): string {
		return 'system-info';
	}

	public function get_title(): string {
		return __( 'System Information', 'mpcaa-connect' );
	}

	public function render(): void {

		echo '<table class="widefat striped">';

		echo '<tbody>';

		$this->row(
			'Plugin',
			MPCAA_CONNECT_VERSION
		);

		$this->row(
			'PHP',
			PHP_VERSION
		);

		$this->row(
			'WordPress',
			get_bloginfo( 'version' )
		);

		echo '</tbody>';

		echo '</table>';
	}

	private function row(
		string $label,
		string $value
	): void {

		echo '<tr>';

		echo '<th>' .
			esc_html( $label ) .
			'</th>';

		echo '<td>' .
			esc_html( $value ) .
			'</td>';

		echo '</tr>';
	}
}