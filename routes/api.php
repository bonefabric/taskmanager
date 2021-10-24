<?php declare(strict_types=1);

/** @var RouterService $router */

use Core\Application;
use Core\Services\RouterService;

$router = Application::getInstance()->getServiceContainer()->getService(\Core\Services\RouterService::class);

$router->group(['prefix' => 'api', 'protectors' => ['auth', 'throttle']], function () use ($router) {

	$router->group(['prefix' => 'v1'], function () use ($router) {

		$router->resource('roles', \Core\Controllers\Api\v1\RoleController::class);

	});
});

//$router->get('/user/{id}/account/{name}', \Core\Controllers\Api\v1\IndexController::class, 'index', [
//	'patterns' => [
//		'id' => '\d+',
//		'name' => '\d+'
//	]
//]);
