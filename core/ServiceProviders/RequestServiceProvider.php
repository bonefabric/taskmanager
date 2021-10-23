<?php declare(strict_types=1);

namespace Core\ServiceProviders;

use Core\Components\ServiceContainer\ServiceProvider;
use Symfony\Component\HttpFoundation\Request;

final class RequestServiceProvider extends ServiceProvider
{

	public function up(): void
	{
		$this->register(Request::createFromGlobals(), true);
	}

}