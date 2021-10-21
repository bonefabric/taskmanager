<?php declare(strict_types=1);

namespace Core\Facades;

final class Router extends BaseFacade
{

	protected const COMPONENT = \Core\Components\Router\Router::class;

	/**
	 * @var object
	 */
	protected static object $component;

	/**
	 * @return \Core\Components\Router\Router
	 */
	public static function get(): \Core\Components\Router\Router
	{
		static::initComponent();
		return static::$component;
	}

}