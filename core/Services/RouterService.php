<?php declare(strict_types=1);

namespace Core\Services;

use Core\Components\Router\Exceptions\RoutesAlreadyLoadedException;

final class RouterService
{

	/**
	 * @var array
	 */
	private array $routes;

	/**
	 * @var bool
	 */
	private bool $isRoutesLoaded = false;

	/**
	 * @throws RoutesAlreadyLoadedException
	 */
	public function loadRoutes(): void
	{
		if (!$this->isRoutesLoaded) {
			$this->routes = include ROOT_PATH . '/config/routes.php';
			foreach ($this->routes as $route) {
				require_once $route;
			}
		} else {
			throw new RoutesAlreadyLoadedException('Routes from config files already loaded.');
		}
		$this->isRoutesLoaded = true;
	}

}