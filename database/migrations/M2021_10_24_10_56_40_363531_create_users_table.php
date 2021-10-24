<?php declare(strict_types=1);

namespace Database\migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Core\Components\Utils\Migrator;
use Illuminate\Database\Schema\Blueprint;

class M2021_10_24_10_56_40_363531_create_users_table extends Migrator
{

	public function up(): void
	{
		Capsule::schema()->create('users', function ($table) {
			/** @var Blueprint $table */
			$table->id();
			$table->string('name', 50);
			$table->string('email', 50)->unique();
			$table->string('password', 50);
			$table->foreignId('role_ref');
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('role_ref')->references('id')->on('roles')->onUpdate('cascade')->onDelete('restrict');

			$table->index('email');
		});
	}

	public function down(): void
	{
		Capsule::schema()->dropIfExists('users');
	}

}
