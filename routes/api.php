<?php declare(strict_types=1);

use Core\Facades\Router;

$router = Router::component();

$router->get('/', \Core\Controllers\Api\v1\IndexController::class, 'index');
