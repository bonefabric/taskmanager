<?php declare(strict_types=1);

namespace Core\Components\ServiceContainer\Contracts;

/**
 * Bootable services uses in singleton services
 */
interface BootableService
{

	public function boot(): void;

}