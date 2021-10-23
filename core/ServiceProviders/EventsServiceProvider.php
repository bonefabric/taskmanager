<?php declare(strict_types=1);

namespace Core\ServiceProviders;

use Core\Components\ServiceContainer\ServiceProvider;
use Core\Services\EventsService;

final class EventsServiceProvider extends ServiceProvider
{

	public function up(): void
	{
		$this->register(new EventsService(), true);
	}
}