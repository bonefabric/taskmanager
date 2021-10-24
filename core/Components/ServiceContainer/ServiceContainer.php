<?php declare(strict_types=1);

namespace Core\Components\ServiceContainer;

use Core\Components\ServiceContainer\Contracts\BootableService;
use Core\Components\ServiceContainer\Contracts\ServiceProviderInterface;
use Core\Components\ServiceContainer\Contracts\StoppableService;
use Core\Components\ServiceContainer\Exceptions\ServiceIsNotExistsException;
use Core\Components\ServiceContainer\Exceptions\ServicesAlreadyLoadedException;
use Symfony\Component\HttpFoundation\Response;

final class ServiceContainer
{

	/**
	 * Loaded services
	 * @var object[]
	 */
	private array $services = [];

	/**
	 * Service providers
	 * @var ServiceProviderInterface[]
	 */
	private array $providers = [];

	/**
	 * Flag - is services already loaded
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
		$this->loadAndUpProviders();
		$this->loadAndBootServices();
		$this->servicesLoaded = true;
	}

	private function loadAndUpProviders(): void
	{
		$providersList = include ROOT_PATH . '/config/services.php';

		foreach ($providersList as $providerClass) {
			/** @var ServiceProviderInterface $provider */
			$provider = new $providerClass();
			$provider->up();
			$this->providers[$provider->getIdentity()] = $provider;
		}
	}

	private function loadAndBootServices(): void
	{
		foreach ($this->providers as $provider) {
			if ($provider->isSingleton()) {
				$service = $provider->getService();
				$this->services[$provider->getIdentity()] = $service;
				if ($service instanceof BootableService) {
					$service->boot();
				}
			}
		}
	}

	/**
	 * @param string $identity
	 * @return object
	 * @throws ServiceIsNotExistsException
	 */
	public function getService(string $identity): object
	{
		if (!$this->providers[$identity]) {
			throw new ServiceIsNotExistsException('Service is not exists ' . $identity . '.');
		}
		$provider = $this->providers[$identity];
		if (!$provider->isSingleton()) {
			return $provider->getService();
		}
		return $this->services[$identity];
	}

	/**
	 * @param array $services
	 * @return array
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
	 * @param Response $response
	 */
	public function downProviders(Response $response): void
	{
		foreach ($this->services as $service) {
			if ($service instanceof StoppableService) {
				$service->stop();
			}
		}
		foreach ($this->providers as $provider) {
			$provider->down($response);
		}
	}

}