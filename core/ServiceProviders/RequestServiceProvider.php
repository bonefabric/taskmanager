<?php

namespace Core\ServiceProviders;

use Symfony\Component\HttpFoundation\Request;

class RequestServiceProvider extends BaseServiceProvider
{

	public function up(): void
	{
		$this->register(Request::createFromGlobals(), true);
	}

	public function down(): void
	{

	}
}