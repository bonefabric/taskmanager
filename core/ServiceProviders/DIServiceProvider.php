<?php declare(strict_types=1);

namespace Core\ServiceProviders;

use Core\Components\ServiceContainer\ServiceProvider;
use Core\Services\DIService;

final class DIServiceProvider extends ServiceProvider
{

	public function up(): void
	{
		$this->register(new DIService(), true);
	}
}