<?php declare(strict_types=1);

namespace Core\Components\Router;

use Symfony\Component\HttpFoundation\Request;

class Route implements RouteInterface
{

	/**
	 * @var string
	 */
	protected string $path;

	/**
	 * @var string
	 */
	protected string $controller;

	/**
	 * @var array
	 */
	protected array $methods;

	/**
	 * @var array
	 */
	protected array $options;

	/**
	 * @param string $path
	 * @param string $controller
	 * @param array $methods
	 * @param array $options
	 */
	public function __construct(string $path, string $controller, array $methods, array $options = [])
	{
		$this->path = $path;
		$this->controller = $controller;
		$this->methods = $methods;
		$this->options = $options;
	}

	/**
	 * @param Request $request
	 * @return bool
	 */
	public function check(Request $request): bool
	{
		return true;
	}

	/**
	 * @return string
	 */
	public function getPath(): string
	{
		return $this->path;
	}

	/**
	 * @return string
	 */
	public function getController(): string
	{
		return $this->controller;
	}

	/**
	 * @return string[]
	 */
	public function getMethods(): array
	{
		return $this->methods;
	}

	/**
	 * @return array
	 */
	public function getOptions(): array
	{
		return $this->options;
	}

}