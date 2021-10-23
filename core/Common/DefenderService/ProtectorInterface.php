<?php declare(strict_types=1);

namespace Core\Common\DefenderService;

interface ProtectorInterface
{

	public function boot(): void;

	/**
	 * @return bool
	 */
	public function check(): bool;

}