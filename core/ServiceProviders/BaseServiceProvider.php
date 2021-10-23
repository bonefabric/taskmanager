<?php declare(strict_types=1);

namespace Core\ServiceProviders;

use Core\Components\ServiceContainer\Contracts\ServiceProviderInterface;

abstract class BaseServiceProvider implements ServiceProviderInterface
{

	/**
	 * @var object
	 */
	protected object $service;

	/**
	 * @var bool
	 */
	protected bool $isSingleton;

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

	public function down(): void
	{

	}
}