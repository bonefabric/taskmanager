<?php declare(strict_types=1);

namespace Core\ServiceProviders;

use Core\Components\ServiceContainer\ServiceProvider;
use Core\Services\PerformanceRecorderService;

class PerformanceRecorderServiceProvider extends ServiceProvider
{

	public function up(): void
	{
		$this->register(new PerformanceRecorderService(), true);
	}
}