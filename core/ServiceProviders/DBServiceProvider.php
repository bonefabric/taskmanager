<?php declare(strict_types=1);

namespace Core\ServiceProviders;

use Core\Components\ServiceContainer\ServiceProvider;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;

final class DBServiceProvider extends ServiceProvider
{

	/**
	 * @throws ORMException
	 */
	public function up(): void
	{
		$this->register(EntityManager::create([
			'driver' => 'pdo_' . $_ENV['DRIVER'],
			'dbname' => $_ENV['DB_NAME'],
			'host' => $_ENV['DB_HOST'],
			'user' => $_ENV['DB_USER'],
			'password' => $_ENV['DB_PASSWORD']
		],
			Setup::createAnnotationMetadataConfiguration([ROOT_PATH . '/core/Entity'], $_ENV['DEBUG'] === 'true',
				null, null, false)), true);
	}
}