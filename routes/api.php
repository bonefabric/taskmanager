<?php declare(strict_types=1);

$router = \Core\Facades\Router::get();

$router->get('/', \Core\Controllers\Api\v1\IndexController::class, 'index');
$router->get('/test', \Core\Controllers\Api\v1\IndexController::class, 'index');
