<?php declare(strict_types=1);

namespace Core;

use Core\Components\DIContainer;

final class Application
{

	/**
	 * @var Application
	 */
	private static Application $instance;

	/**
	 * @var DIContainer
	 */
	private DIContainer $container;

	private function __construct()
	{
		$this->container = new DIContainer();
	}

	/**
	 * @return Application
	 */
	public static function getInstance(): Application
	{
		if (!isset(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function init(): void
	{
		require_once ROOT_PATH . '/bootstrap/bootstrap.php';
	}

	public function start(): void
	{

	}

	public function finish(): void
	{

	}

}