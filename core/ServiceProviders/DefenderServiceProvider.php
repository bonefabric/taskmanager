<?php declare(strict_types=1);

namespace Core\ServiceProviders;

use Core\Components\ServiceContainer\ServiceProvider;
use Core\Services\DefenderService;

final class DefenderServiceProvider extends ServiceProvider
{

	public function up(): void
	{
		$this->register(new DefenderService(), true);
	}

}