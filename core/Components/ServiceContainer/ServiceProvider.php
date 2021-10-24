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
	 * @var string
	 */
	protected string $identity;

	/**
	 * @param object $service
	 * @param bool $isSingleton
	 * @param string|null $identity
	 */
	protected function register(object $service, bool $isSingleton = false, string $identity = null): void
	{
		$this->service = $service;
		$this->isSingleton = $isSingleton;
		is_null($identity) ? $this->identity = get_class($service) : $this->identity = $identity;
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

	/**
	 * @return string
	 */
	public function getIdentity(): string
	{
		return $this->identity;
	}

}