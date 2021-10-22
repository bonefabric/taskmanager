<?php declare(strict_types=1);

use Core\Facades\Router;

Router::component()->group(['prefix' => 'api'], function () {

	Router::component()->group(['prefix' => 'v1'], function () {

		Router::component()->resource('tasks', \Core\Controllers\Api\v1\TasksController::class);

	});
});

//$router->get('/user/{id}/account/{name}', \Core\Controllers\Api\v1\IndexController::class, 'index', [
//	'patterns' => [
//		'id' => '\d+',
//		'name' => '\d+'
//	]
//]);
