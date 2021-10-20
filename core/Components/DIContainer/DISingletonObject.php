<?php declare(strict_types=1);

namespace Core\Components\DIContainer;

class DISingletonObject implements DIObjectInterface
{

	/**
	 * @var object
	 */
	private object $instance;

	public function __construct(object $instance)
	{
		$this->instance = $instance;
	}

	public function get(): object
	{
		return $this->instance;
	}
}