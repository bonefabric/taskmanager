<?php declare(strict_types=1);

namespace Core\Facades;

final class EntityManager extends BaseFacade
{

	protected const COMPONENT = \Doctrine\ORM\EntityManager::class;

	/**
	 * @var object
	 */
	protected static object $component;

	/**
	 * @return \Doctrine\ORM\EntityManager
	 */
	public static function component(): \Doctrine\ORM\EntityManager
	{
		static::initComponent();
		return static::$component;
	}

}