<?php declare(strict_types=1);

namespace Database\migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Core\Components\Utils\Migrator;
use Illuminate\Database\Schema\Blueprint;

class M2021_10_24_10_26_17_346831_create_roles_table extends Migrator
{

	public function up(): void
	{
		Capsule::schema()->create('roles', function ($table) {
			/** @var Blueprint $table */
			$table->id();
			$table->string('name', 50);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down(): void
	{
		Capsule::schema()->dropIfExists('roles');
	}

}
