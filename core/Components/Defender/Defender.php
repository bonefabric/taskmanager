<?php declare(strict_types=1);

namespace Core\Components\Defender;

use Core\Components\Router\RouteInterface;

final class Defender
{

	/**
	 * @param RouteInterface $route
	 * @return bool
	 */
	public function checkRoute(RouteInterface $route): bool
	{
		return true;
	}

}