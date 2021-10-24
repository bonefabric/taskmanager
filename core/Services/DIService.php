<?php declare(strict_types=1);

namespace Core\Services;

use ReflectionClass;
use ReflectionException;

final class DIService
{

	/**
	 * @param string $class
	 * @return array
	 * @throws ReflectionException
	 */
	public function getConstructorParams(string $class): array
	{
		$constructor = (new ReflectionClass($class))->getConstructor();
		$options = [];
		if (!is_null($constructor)) {
			foreach ($constructor->getParameters() as $parameter) {
				$type = $parameter->getType();
				if (!is_null($type)) {
					$options[$parameter->getPosition()] = $type->getName();
				}
			}
		}
		return $options;
	}

}