<?php declare(strict_types=1);

namespace Core\Protectors;

final class AuthProtector extends BaseProtector
{

	/**
	 * @return bool
	 */
	public function check(): bool
	{
		return true;
	}

}