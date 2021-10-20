<?php declare(strict_types=1);

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;

require_once __DIR__ . '/../vendor/autoload.php';

(Dotenv\Dotenv::createImmutable(__DIR__ . '../'))->safeLoad();

$config = Setup::createAnnotationMetadataConfiguration([
    __DIR__ . '/../src/Entity'
], isset($_ENV['DEBUG']) && $_ENV['DEBUG'] === 'true');

$connection = [
  'driver' => 'pdo_pgsql',
  'user' => 'taskmanager',
  'password' => 'taskmanager229!',
  'host' => 'localhost',
  'port' => '5432'
];

$entityManager = EntityManager::create($connection, $config);

return ConsoleRunner::createHelperSet($entityManager);