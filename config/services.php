<?php declare(strict_types=1);

/**
 * Список провайдеров сервисов
 */
return [
	\Core\ServiceProviders\RouterServiceProvider::class,
	\Core\ServiceProviders\RequestServiceProvider::class,
	\Core\ServiceProviders\DIServiceProvider::class,
	\Core\ServiceProviders\DefenderServiceProvider::class,
	\Core\ServiceProviders\DBServiceProvider::class,
	\Core\ServiceProviders\CSRFServiceProvider::class,
	\Core\ServiceProviders\EventsServiceProvider::class,
	\Core\ServiceProviders\PerformanceRecorderServiceProvider::class,
];