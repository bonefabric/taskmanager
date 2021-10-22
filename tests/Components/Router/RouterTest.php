<?php

namespace Tests\Components\Router;

use Core\Components\Router\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{

	protected Router $router;

	protected function setUp(): void
	{
		$this->router = new Router();
	}

	public function testGet(): void
	{
		$this->router->get('/test', self::class, 'controller');
	}

	public function controller(): void
	{

	}
}
