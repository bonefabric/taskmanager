<?php declare(strict_types=1);

namespace Core\Services;

use Core\Common\DefenderService\ProtectorInterface;
use Core\Common\RouterService\Route;
use Core\Components\ServiceContainer\Contracts\BootableService;

final class DefenderService implements BootableService
{

	/**
	 * @var ProtectorInterface[]
	 */
	private array $protectors;


	/**
	 * @return bool
	 */
	public function accessed(Route $route): bool
	{
		return true;
	}

	public function boot(): void
	{

	}
}