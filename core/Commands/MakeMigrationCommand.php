<?php declare(strict_types=1);

namespace Core\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class MakeMigrationCommand extends Command
{

	protected static $defaultName = 'make:migration';

	protected static $defaultDescription = 'Make new migration.';

	protected function configure(): void
	{
		$this->setHelp('Make new migration.');
		$this->addArgument('name', InputArgument::REQUIRED);
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$name = $input->getArgument('name');
		$class = 'M' . (new \DateTime())->format('Y_m_d_H_i_s_u') . '_create_' .  $name . '_table';
		$file = fopen(ROOT_PATH . '/database/migrations/' . $class . '.php', 'wb+');

		$defaultContent = <<<DATA
<?php declare(strict_types=1);

namespace Database\migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Core\Components\Utils\Migrator;
use Illuminate\Database\Schema\Blueprint;

class {$class} extends Migrator
{

	public function up(): void
	{
		Capsule::schema()->create('{$name}', function (\$table) {
			/** @var Blueprint $table */
			\$table->id();
			
		});
	}

	public function down(): void
	{
		Capsule::schema()->dropIfExists('{$name}');
	}

}

DATA;

		fwrite($file, $defaultContent);
		fclose($file);

		$output->write('Migration created successful.');

		return Command::SUCCESS;
	}

}