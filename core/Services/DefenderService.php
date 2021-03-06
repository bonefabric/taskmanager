<?php declare(strict_types=1);

namespace Core\Services;

use Core\Application;
use Core\Common\DefenderService\ProtectorException;
use Core\Common\DefenderService\ProtectorInterface;
use Core\Common\RouterService\RouteInterface;
use Core\Components\ServiceContainer\Contracts\BootableService;
use Core\Components\ServiceContainer\Exceptions\ServiceIsNotExistsException;
use ReflectionException;

final class DefenderService implements BootableService
{

	/**
	 * @var string[]
	 */
	private array $protectorsConfig;

	/**
	 * @param RouteInterface $route
	 * @return bool
	 * @throws ProtectorException
	 * @throws ServiceIsNotExistsException
	 * @throws ReflectionException
	 */
	public function accessed(RouteInterface $route): bool
	{
		$routeProtectors = $route->getProtectors();
		foreach ($routeProtectors as $protectorIdentity) {
			if (empty($this->protectorsConfig['protectors'][$protectorIdentity])) {
				throw new ProtectorException('Protector ' . $protectorIdentity . ' not found.');
			}
			$protectorClass = $this->protectorsConfig['protectors'][$protectorIdentity];

			/** @var DIService $DIService */
			$DIService = Application::getInstance()->getServiceContainer()->getService(DIService::class);
			$constructorParams = $DIService->getConstructorParams($protectorClass);
			$params = Application::getInstance()->getServiceContainer()->getServicesArray($constructorParams);
			$protector = new $protectorClass(...$params);
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