<?php declare(strict_types=1);

namespace Core\ServiceProviders;

use Core\Services\RouterService;

final class RouterServiceProvider extends BaseServiceProvider
{

	public function up(): void
	{
		$this->register(new RouterService(), true);
	}

}