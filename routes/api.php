<?php declare(strict_types=1);

/** @var RouterService $router */

use Core\Application;
use Core\Services\RouterService;

$router = Application::getInstance()->getServiceContainer()->getService(\Core\Services\RouterService::class);

$router->group(['prefix' => 'api', 'protectors' => ['auth']], function () use ($router) {

	$router->group(['prefix' => 'v1'], function () use ($router) {

		$router->resource('tasks', \Core\Controllers\Api\v1\TasksController::class);

	});
});

//$router->get('/user/{id}/account/{name}', \Core\Controllers\Api\v1\IndexController::class, 'index', [
//	'patterns' => [
//		'id' => '\d+',
//		'name' => '\d+'
//	]
//]);
