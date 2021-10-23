<?php declare(strict_types=1);

namespace Core\ServiceProviders;

use Core\Services\DefenderService;

final class DefenderServiceProvider extends BaseServiceProvider
{

	public function up(): void
	{
		$this->register(new DefenderService(), true);
	}

}