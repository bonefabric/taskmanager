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
	 * @var string
	 */
	protected string $controllerMethod;

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
	public function __construct(string $path, string $controller, string $controllerMethod, array $methods, array $options = [])
	{
		$this->path = $path;
		$this->controller = $controller;
		$this->controllerMethod = $controllerMethod;
		$this->methods = $methods;
		$this->options = $options;
	}

	/**
	 * @param Request $request
	 * @return bool
	 */
	public function check(Request $request): bool
	{
		return $this->compare($request);
	}

	/**
	 * @param Request $request
	 * @return bool
	 */
	protected function compare(Request $request): bool
	{
		//TODO regex
		return trim($request->server->get('REQUEST_URI'), '/') === trim($this->path, '/')
			&& in_array(strtoupper($request->server->get('REQUEST_METHOD')), $this->methods, true);
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
	 * @return string
	 */
	public function getControllerMethod(): string
	{
		return $this->controllerMethod;
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