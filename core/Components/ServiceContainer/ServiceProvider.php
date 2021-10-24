<?php declare(strict_types=1);

namespace Core\Components\ServiceContainer;

use Core\Components\ServiceContainer\Contracts\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class ServiceProvider implements ServiceProviderInterface
{

	/**
	 * @var object
	 */
	protected object $service;

	/**
	 * @var bool
	 */
	protected bool $isSingleton = false;

	/**
	 * @param object $service
	 * @param bool $isSingleton
	 */
	protected function register(object $service, bool $isSingleton = false): void
	{
		$this->service = $service;
		$this->isSingleton = $isSingleton;
	}

	/**
	 * @return bool
	 */
	public function isSingleton(): bool
	{
		return $this->isSingleton;
	}

	/**
	 * @return object
	 */
	public function getService(): object
	{
		if ($this->isSingleton) {
			return $this->service;
		}
		$class = get_class($this->service);
		return new $class();
	}

	/**
	 * @param Response $response
	 */
	public function down(Response $response): void
	{

	}

}