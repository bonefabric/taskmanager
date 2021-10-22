<?php declare(strict_types=1);

use Core\Components\Utils\ExceptionHandler;
use Dotenv\Dotenv;

ExceptionHandler::init();
(Dotenv::createImmutable(ROOT_PATH))->safeLoad();
