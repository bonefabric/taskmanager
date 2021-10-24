#!/usr/bin/env php

<?php

use Core\Commands\MakeMigrationCommand;
use Core\Commands\MigrateCommand;
use Symfony\Component\Console\Application;

define('ROOT_PATH', dirname(__DIR__));

require_once __DIR__ . '/../vendor/autoload.php';
$application = new Application();

$application->add(new MakeMigrationCommand());
$application->add(new MigrateCommand());

try {
	$application->run();
} catch (Exception $e) {
    echo $e->getMessage();
}