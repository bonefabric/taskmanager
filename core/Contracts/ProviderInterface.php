<?php declare(strict_types=1);

namespace Core\Contracts;

interface ProviderInterface
{

	public function boot(): void;

	/**
	 * @param ServiceInterface $service
	 */
	public function register(ServiceInterface $service): void;

}