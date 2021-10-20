<?php declare(strict_types=1);

namespace Core\Components;

use Core\Components\DIContainer\DIObject;
use Core\Components\DIContainer\DIObjectInterface;

final class DIContainer
{

	/**
	 * @var DIObjectInterface[]
	 */
	private array $objects = [];

	/**
	 * @param string $identifier
	 * @param string $object
	 * @param array $params
	 */
	public function bind(string $identifier, string $class, array $params): void
	{
		$this->objects[$identifier] = new DIObject($class, $params);
	}

	/**
	 * @param object $object
	 */
	public function bindSingleton(object $object): void
	{
		$this->objects[get_class($object)] = $object;
	}

	/**
	 * @param string $identifier
	 * @return object|null
	 */
	public function get(string $identifier): ?object
	{
		if (!isset($this->objects[$identifier])) {
			return null;
		}
		return $this->objects[$identifier]->get();
	}

}