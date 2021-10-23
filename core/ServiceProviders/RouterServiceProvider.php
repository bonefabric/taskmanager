<?php declare(strict_types=1);

namespace Core\ServiceProviders;

use Core\Components\ServiceContainer\ServiceProvider;
use Core\Services\RouterService;

final class RouterServiceProvider extends ServiceProvider
{

	public function up(): void
	{
		$this->register(new RouterService(), true);
	}

}