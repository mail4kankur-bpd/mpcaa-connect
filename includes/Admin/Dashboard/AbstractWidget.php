<?php
/**
 * Abstract Dashboard Widget
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Admin\Dashboard;

defined( 'ABSPATH' ) || exit;

abstract class AbstractWidget implements WidgetInterface {

	protected function e( string $text ): void {
		echo esc_html( $text );
	}
}