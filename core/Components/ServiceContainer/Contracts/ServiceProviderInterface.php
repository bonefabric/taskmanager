<?php declare(strict_types=1);

namespace Core\Components\ServiceContainer\Contracts;

interface ServiceProviderInterface
{

	public function up(): void;

	public function down(): void;

	/**
	 * @return bool
	 */
	public function isSingleton(): bool;

	/**
	 * @return object
	 */
	public function getService(): object;


}