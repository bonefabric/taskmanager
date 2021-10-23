<?php declare(strict_types=1);

namespace Core\Protectors;

use Core\Common\DefenderService\ProtectorInterface;

abstract class BaseProtector implements ProtectorInterface
{

	public function boot(): void
	{
	}

	/**
	 * @return bool
	 */
	public function check(): bool
	{
		return false;
	}
}