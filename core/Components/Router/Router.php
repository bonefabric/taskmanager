<?php declare(strict_types=1);

namespace Core\Components\Router;

use Symfony\Component\HttpFoundation\Request;

final class Router
{

	/**
	 * @var RouteInterface[]
	 */
	private array $routes = [];

	/**
	 * @var RouteInterface
	 */
	private RouteInterface $fallbackRoute;

	/**
	 * @param Request $request
	 * @return RouteInterface
	 * @throws RouterException
	 */
	public function handle(Request $request): RouteInterface
	{
		foreach ($this->routes as $route) {
			if ($route->check($request)) {
				return $route;
			}
		}
		if (!isset($this->fallbackRoute)) {
			throw new RouterException('Route not found.');
		}
		return $this->fallbackRoute;
	}

	/**
	 * @param string $path
	 * @param string $controller
	 * @param string|null $method
	 * @param array $options
	 */
	public function get(string $path, string $controller, string $method = null, array $options = []): void
	{
		$this->routes[] = new Route($path, $controller, $method, [RouteInterface::METHOD_GET], $options);
	}

	/**
	 * @param string $path
	 * @param string $controller
	 * @param string|null $method
	 * @param array $options
	 */
	public function post(string $path, string $controller, string $method = null, array $options = []): void
	{
		$this->routes[] = new Route($path, $controller, $method, [RouteInterface::METHOD_POST], $options);
	}

	/**
	 * @param string $path
	 * @param string $controller
	 * @param string|null $method
	 * @param array $options
	 */
	public function put(string $path, string $controller, string $method = null, array $options = []): void
	{
		$this->routes[] = new Route($path, $controller, $method, [RouteInterface::METHOD_PUT], $options);
	}

	/**
	 * @param string $path
	 * @param string $controller
	 * @param string|null $method
	 * @param array $options
	 */
	public function patch(string $path, string $controller, string $method = null, array $options = []): void
	{
		$this->routes[] = new Route($path, $controller, $method, [RouteInterface::METHOD_PATCH], $options);
	}

	/**
	 * @param string $path
	 * @param string $controller
	 * @param string|null $method
	 * @param array $options
	 */
	public function delete(string $path, string $controller, string $method = null, array $options = []): void
	{
		$this->routes[] = new Route($path, $controller, $method, [RouteInterface::METHOD_DELETE], $options);
	}

	/**
	 * @param string $resource
	 * @param string $controller
	 * @param array $options
	 */
	public function resource(string $resource, string $controller, array $options = []): void
	{
		$this->get('/' . $resource, $controller, 'index');
		$this->post('/' . $resource, $controller, 'create');
		$this->patch('/' . $resource . '/{id}', $controller, 'edit', [
			'patterns' => [
				'id' => '\d+'
			]
		]);
		$this->delete('/' . $resource . '/{id}', $controller, 'delete', [
			'patterns' => [
				'id' => '\d+'
			]
		]);

	}

	/**
	 * @param array $options
	 * @param callable $group
	 */
	public function group(array $options, callable $group): void
	{
		//TODO group
	}

	/**
	 * @param string $controller
	 * @param string|null $method
	 * @param array $options
	 */
	public function fallback(string $controller, string $method = null, array $options = []): void
	{
		$this->fallbackRoute = new Route('', $controller, $method, RouteInterface::METHODS_ALL, $options);
	}

}