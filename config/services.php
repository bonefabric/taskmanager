<?php declare(strict_types=1);

/**
 * Список провайдеров сервисов
 */
return [
	\Core\ServiceProviders\RouterServiceProvider::class,
	\Core\ServiceProviders\RequestServiceProvider::class,
	\Core\ServiceProviders\DIServiceProvider::class,
	\Core\Services\DefenderService::class,
];