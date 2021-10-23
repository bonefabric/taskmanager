<?php declare(strict_types=1);

namespace Core\ServiceProviders;

use Core\Services\DIService;

final class DIServiceProvider extends BaseServiceProvider
{

	public function up(): void
	{
		$this->register(new DIService(), true);
	}
}