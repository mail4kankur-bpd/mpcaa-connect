<?php
/**
 * Dashboard Page
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Admin;

use MPCAAConnect\Admin\Dashboard\DashboardController;
use MPCAAConnect\Admin\Dashboard\StatisticsWidget;
use MPCAAConnect\Admin\Dashboard\QuickActionsWidget;
use MPCAAConnect\Admin\Dashboard\SystemInfoWidget;

defined( 'ABSPATH' ) || exit;

final class Dashboard {

	/**
	 * Render dashboard.
	 *
	 * @return void
	 */
	public function render(): void {

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die(
				esc_html__( 'Access denied.', 'mpcaa-connect' )
			);
		}

		$controller = new DashboardController();

		$controller->widgets()->register(
			new StatisticsWidget()
		);

		$controller->widgets()->register(
			new QuickActionsWidget()
		);

		$controller->widgets()->register(
			new SystemInfoWidget()
		);

		?>

		<div class="wrap mpcaa-dashboard">

			<h1><?php esc_html_e( 'MPCAA Connect', 'mpcaa-connect' ); ?></h1>

			<p class="description">
				<?php esc_html_e(
					'Commercial Alumni Management System',
					'mpcaa-connect'
				); ?>
			</p>

			<?php
			$controller->widgets()->render();
			?>

		</div>

		<?php
	}
}