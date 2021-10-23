<?php declare(strict_types=1);

namespace Core\Components\ServiceContainer;

use Core\Components\ServiceContainer\Contracts\ServiceProviderInterface;
use Core\Components\ServiceContainer\Exceptions\ServiceIsNotExistsException;
use Core\Components\ServiceContainer\Exceptions\ServicesAlreadyLoadedException;

final class ServiceContainer
{

	/**
	 * @var object[]
	 */
	private array $services = [];

	/**
	 * @var ServiceProviderInterface[]
	 */
	private array $providers = [];

	/**
	 * @var bool
	 */
	private bool $servicesLoaded = false;

	/**
	 * @throws ServicesAlreadyLoadedException
	 */
	public function loadServices(): void
	{
		if ($this->servicesLoaded) {
			throw new ServicesAlreadyLoadedException('Services already loaded.');
		}
		$serviceProvidersList = include ROOT_PATH . '/config/services.php';
		foreach ($serviceProvidersList as $providerClass) {
			/** @var ServiceProviderInterface $provider */
			$provider = new $providerClass();
			$this->loadService($provider);
		}
		$this->servicesLoaded = true;
	}

	private function bind(ServiceProviderInterface $provider): void
	{
		$serviceClass = get_class($provider->getService());
		$this->providers[$serviceClass] = $provider;
	}

	/**
	 * @param string $service
	 * @return object
	 * @throws ServiceIsNotExistsException
	 */
	public function getService(string $service): object
	{
		if (!$this->providers[$service]) {
			throw new ServiceIsNotExistsException('Service is not exists ' . $service . '.');
		}
		$provider = $this->providers[$service];
		if (!$provider->isSingleton()) {
			return $provider->getService();
		}
		if (!empty($this->services[$service])) {
			return $this->services[$service];
		}
		$this->services[$service] = $provider->getService();
		return $this->services[$service];
	}

	/**
	 * @param string[] $services
	 * @return object[]
	 * @throws ServiceIsNotExistsException
	 */
	public function getServicesArray(array $services): array
	{
		$result = [];
		foreach ($services as $service) {
			$result[] = $this->getService($service);
		}
		return $result;
	}

	/**
	 * @param ServiceProviderInterface $provider
	 */
	private function loadService(ServiceProviderInterface $provider): void
	{
		$provider->up();
		$this->bind($provider);
	}

	public function downProviders(): void
	{
		foreach ($this->providers as $provider) {
			$provider->down();
		}
	}

}