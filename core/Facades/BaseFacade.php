<?php declare(strict_types=1);

namespace Core\Facades;

use Core\Application;

abstract class BaseFacade
{

	protected const COMPONENT = '';

	/**
	 * @var object
	 */
	protected static object $component;

	protected static function initComponent(): void
	{
		if (!isset(static::$component)) {
			static::$component = Application::getInstance()->getComponent(static::COMPONENT);
		}
	}
}