<?php declare(strict_types=1);

namespace Core\Commands;

use Core\Components\Utils\Migrator;
use Illuminate\Database\Capsule\Manager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class MigrateCommand extends Command
{

	protected static $defaultName = 'migrate';

	protected static $defaultDescription = 'Start migration';

	protected function configure(): void
	{
		require_once ROOT_PATH . '/bootstrap/bootstrap.php';
	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 * @return int
	 */
	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$capsule = new Manager();

		//TODO Добавить другие БД
		$capsule->addConnection([
			'driver' => $_ENV['DRIVER'],
			'host' => $_ENV['DB_HOST'],
			'database' => $_ENV['DB_NAME'],
			'username' => $_ENV['DB_USER'],
			'password' => $_ENV['DB_PASSWORD'],
		]);

		$capsule->setAsGlobal();

		$migrations = include ROOT_PATH . '/database/migrations.php';

		foreach ($migrations as $migration) {
			/** @var Migrator $migrator */
			$migrator = new $migration();
			$migrator->down();
			$migrator->up();
		}

		return Command::SUCCESS;
	}

}