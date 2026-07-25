<?php
/**
 * Core Loader
 *
 * @package MPCAAConnect
 */

declare(strict_types=1);

namespace MPCAAConnect\Core;

defined( 'ABSPATH' ) || exit;

/**
 * Registers and executes WordPress hooks.
 */
final class Loader {

	/**
	 * Action hooks.
	 *
	 * @var array<int,array<string,mixed>>
	 */
	private array $actions = array();

	/**
	 * Filter hooks.
	 *
	 * @var array<int,array<string,mixed>>
	 */
	private array $filters = array();

	/**
	 * Register an action.
	 *
	 * @param string $hook Hook name.
	 * @param object $component Component instance.
	 * @param string $callback Callback method.
	 * @param int    $priority Priority.
	 * @param int    $accepted_args Accepted arguments.
	 *
	 * @return void
	 */
	public function add_action(
		string $hook,
		object $component,
		string $callback,
		int $priority = 10,
		int $accepted_args = 1
	): void {

		$this->actions[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args,
		);
	}

	/**
	 * Register a filter.
	 *
	 * @param string $hook Hook name.
	 * @param object $component Component instance.
	 * @param string $callback Callback method.
	 * @param int    $priority Priority.
	 * @param int    $accepted_args Accepted arguments.
	 *
	 * @return void
	 */
	public function add_filter(
		string $hook,
		object $component,
		string $callback,
		int $priority = 10,
		int $accepted_args = 1
	): void {

		$this->filters[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args,
		);
	}

	/**
	 * Execute all registered hooks.
	 *
	 * @return void
	 */
	public function run(): void {

		foreach ( $this->filters as $filter ) {

			add_filter(
				$filter['hook'],
				array(
					$filter['component'],
					$filter['callback'],
				),
				$filter['priority'],
				$filter['accepted_args']
			);
		}

		foreach ( $this->actions as $action ) {

			add_action(
				$action['hook'],
				array(
					$action['component'],
					$action['callback'],
				),
				$action['priority'],
				$action['accepted_args']
			);
		}
	}

	/**
	 * Return all registered actions.
	 *
	 * @return array<int,array<string,mixed>>
	 */
	public function get_actions(): array {
		return $this->actions;
	}

	/**
	 * Return all registered filters.
	 *
	 * @return array<int,array<string,mixed>>
	 */
	public function get_filters(): array {
		return $this->filters;
	}

	/**
	 * Reset loader.
	 *
	 * @return void
	 */
	public function reset(): void {
		$this->actions = array();
		$this->filters = array();
	}
}