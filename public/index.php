<?php declare(strict_types=1);

use Core\Application;

define('ROOT_PATH', dirname(__DIR__));

require_once ROOT_PATH . '/vendor/autoload.php';

$application = Application::getInstance();

$application->init();
$application->start();
$application->finish();