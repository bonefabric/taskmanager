<?php declare(strict_types=1);

namespace Core\Services;

use Core\Application;
use Core\Common\DefenderService\ProtectorException;
use Core\Common\DefenderService\ProtectorInterface;
use Core\Common\RouterService\RouteInterface;
use Core\Components\ServiceContainer\Contracts\BootableService;

final class DefenderService implements BootableService
{

	/**
	 * @var string[]
	 */
	private array $protectorsConfig;

	/**
	 * @var ProtectorInterface[]
	 */
	private array $protectors = [];

	/**
	 * @param RouteInterface $route
	 * @return bool
	 * @throws ProtectorException
	 */
	public function accessed(RouteInterface $route): bool
	{
		$routeProtectors = $route->getProtectors();
		foreach ($routeProtectors as $protectorIdentity) {
			if (empty($this->protectorsConfig['protectors'][$protectorIdentity])) {
				throw new ProtectorException('Protector ' . $protectorIdentity . ' not found.');
			}
			$protectorClass = $this->protectorsConfig['protectors'][$protectorIdentity];
			$protector = new $protectorClass();
			if (!$protector instanceof ProtectorInterface) {
				throw new ProtectorException('Protector ' . $protectorClass . ' must implement Core\Common\DefenderService\ProtectorInterface.');
			}
			if (!$protector->check()) {
				return false;
			}
		}
		return true;
	}

	//TODO добавить кэширование конфигов
	public function boot(): void
	{
		$this->protectorsConfig = include ROOT_PATH . '/config/protectors.php';
	}
}