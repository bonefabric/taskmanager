<?php declare(strict_types=1);

namespace Core\Components\DIContainer;

final class DIObject implements DIObjectInterface
{

	/**
	 * @var string
	 */
	private string $class;

	/**
	 * @var array
	 */
	private array $params;

	/**
	 * @param string $class
	 * @param array $params
	 */
	public function __construct(string $class, array $params = [])
	{
		$this->class = $class;
		$this->params = $params;
	}

	/**
	 * @return object
	 */
	public function get(): object
	{
		return new $this->class(...$this->params);
	}
}