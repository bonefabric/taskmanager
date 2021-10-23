<?php declare(strict_types=1);

use Core\Application;
use Core\Services\RouterService;

/** @var RouterService $router */
$router = Application::getInstance()->getServiceContainer()->getService(\Core\Services\RouterService::class);

$router->get('/', \Core\Controllers\Api\v1\IndexController::class, 'index');
$router->fallback(\Core\Controllers\Api\v1\IndexController::class, 'index');