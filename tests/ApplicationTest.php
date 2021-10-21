<?php declare(strict_types=1);

namespace Tests;

use Core\Application;
use Core\Components\Router\Router;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{

	public function testGetInstance(): void
	{
		$this->assertInstanceOf(Application::class, Application::getInstance());
	}

}
