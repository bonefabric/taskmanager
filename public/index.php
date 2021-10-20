<?php declare(strict_types=1);

use core\Application;

define('ROOT_PATH', dirname(__DIR__));

require_once ROOT_PATH . '/vendor/autoload.php';

$application = new Application();

$application->init();
$application->start();
$application->finish();