<?php declare(strict_types=1);

namespace Core\ServiceProviders;

use Symfony\Component\HttpFoundation\Request;

final class RequestServiceProvider extends BaseServiceProvider
{

	public function up(): void
	{
		$this->register(Request::createFromGlobals(), true);
	}

}