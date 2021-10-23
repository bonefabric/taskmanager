<?php declare(strict_types=1);

namespace Core\Protectors;

use Core\Common\DefenderService\Protector;

final class AuthProtector extends Protector
{

	/**
	 * @return bool
	 */
	public function check(): bool
	{
		return true;
	}

}