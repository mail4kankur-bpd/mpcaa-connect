<?php
/**
 * Quick Actions Widget
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Admin\Dashboard;

defined( 'ABSPATH' ) || exit;

final class QuickActionsWidget extends AbstractWidget {

	public function get_id(): string {
		return 'quick-actions';
	}

	public function get_title(): string {
		return __( 'Quick Actions', 'mpcaa-connect' );
	}

	public function render(): void {

		$actions = array(
			'Members',
			'Applications',
			'Payments',
			'QR Verification',
			'Reports',
			'Settings',
		);

		echo '<div class="mpcaa-actions">';

		foreach ( $actions as $action ) {

			echo '<button class="button button-primary" style="margin:5px;">';

			echo esc_html( $action );

			echo '</button>';
		}

		echo '</div>';
	}
}