<?php declare(strict_types=1);

namespace Core\Components\ServiceContainer\Contracts;

use Symfony\Component\HttpFoundation\Response;

/**
 * Service provider interface
 */
interface ServiceProviderInterface
{

	public function up(): void;

	/**
	 * @param Response $response
	 */
	public function down(Response $response): void;

	/**
	 * @return bool
	 */
	public function isSingleton(): bool;

	/**
	 * @return object
	 */
	public function getService(): object;

	/**
	 * @return string
	 */
	public function getIdentity(): string;

}