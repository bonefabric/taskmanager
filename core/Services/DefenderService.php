<?php declare(strict_types=1);

namespace Core\Services;

use Core\Common\DefenderService\ProtectorInterface;

final class DefenderService
{

	/**
	 * @var ProtectorInterface[]
	 */
	private array $protectors;


	/**
	 * @return bool
	 */
	public function accessed(): bool
	{
		return true;
	}

}