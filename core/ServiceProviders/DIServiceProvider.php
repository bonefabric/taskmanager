<?php

namespace Core\ServiceProviders;

use Core\Services\DIService;

class DIServiceProvider extends BaseServiceProvider
{

	public function up(): void
	{
		$this->register(new DIService(), true);
	}

	public function down(): void
	{

	}
}