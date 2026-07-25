<?php
/**
 * Statistics Widget
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Admin\Dashboard;

defined( 'ABSPATH' ) || exit;

final class StatisticsWidget extends AbstractWidget {

	public function get_id(): string {
		return 'statistics';
	}

	public function get_title(): string {
		return __( 'Statistics', 'mpcaa-connect' );
	}

	public function render(): void {

		$stats = array(
			'Members'              => 0,
			'Pending Applications' => 0,
			'Payments'             => 0,
			'Elections'            => 0,
		);

		echo '<div class="mpcaa-stat-grid">';

		foreach ( $stats as $label => $value ) {

			echo '<div class="mpcaa-stat-card">';

			echo '<div class="mpcaa-stat-value">' .
				esc_html( (string) $value ) .
				'</div>';

			echo '<div class="mpcaa-stat-label">' .
				esc_html( $label ) .
				'</div>';

			echo '</div>';
		}

		echo '</div>';
	}
}