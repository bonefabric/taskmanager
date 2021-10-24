<?php declare(strict_types=1);

namespace Core\Services;

use Core\Common\RouterService\Exceptions\RoutesAlreadyLoadedException;
use Core\Common\RouterService\Route;
use Core\Common\RouterService\RouteInterface;
use Core\Components\ServiceContainer\Contracts\BootableService;
use Symfony\Component\HttpFoundation\Request;

/**
 * TODO кэширование маршрутов
 */
final class RouterService implements BootableService
{

	/**
	 * @var bool
	 */
	private bool $isRoutesLoaded = false;

	/**
	 * @var RouteInterface[]
	 */
	private array $routes = [];

	/**
	 * @var RouteInterface
	 */
	private RouteInterface $fallbackRoute;

	/**
	 * @var array
	 */
	private array $currentGroupOptions = [];

	/**
	 * @throws RoutesAlreadyLoadedException
	 */
	private function loadRoutes(): void
	{
		if (!$this->isRoutesLoaded) {
			$routeLists = include ROOT_PATH . '/config/routes.php';
			foreach ($routeLists as $route) {
				require_once $route;
			}
		} else {
			throw new RoutesAlreadyLoadedException('Routes from config files already loaded.');
		}
		$this->isRoutesLoaded = true;
	}

	/**
	 * @param Request $request
	 * @return RouteInterface|null
	 * @throws RoutesAlreadyLoadedException
	 */
	public function handle(Request $request): ?RouteInterface
	{
		foreach ($this->routes as $route) {
			if ($route->check($request)) {
				return $route;
			}
		}
		return $this->fallbackRoute ?? null;
	}

	/**
	 * @param string $path
	 * @param string $controller
	 * @param string|null $method
	 * @param array $options
	 */
	public function get(string $path, string $controller, string $method = null, array $options = []): void
	{
		$route = new Route($path, $controller, $method, [RouteInterface::METHOD_GET], $options);
		$this->applyOptions($route, $options);
		$this->applyGroupOptions($route);
		$this->routes[] = $route;
	}

	/**
	 * @param string $path
	 * @param string $controller
	 * @param string|null $method
	 * @param array $options
	 */
	public function post(string $path, string $controller, string $method = null, array $options = []): void
	{
		$route = new Route($path, $controller, $method, [RouteInterface::METHOD_POST], $options);
		$this->applyOptions($route, $options);
		$this->applyGroupOptions($route);
		$this->routes[] = $route;
	}

	/**
	 * @param string $path
	 * @param string $controller
	 * @param string|null $method
	 * @param array $options
	 */
	public function put(string $path, string $controller, string $method = null, array $options = []): void
	{
		$route = new Route($path, $controller, $method, [RouteInterface::METHOD_PUT], $options);
		$this->applyOptions($route, $options);
		$this->applyGroupOptions($route);
		$this->routes[] = $route;
	}

	/**
	 * @param string $path
	 * @param string $controller
	 * @param string|null $method
	 * @param array $options
	 */
	public function patch(string $path, string $controller, string $method = null, array $options = []): void
	{
		$route = new Route($path, $controller, $method, [RouteInterface::METHOD_PATCH], $options);
		$this->applyOptions($route, $options);
		$this->applyGroupOptions($route);
		$this->routes[] = $route;
	}

	/**
	 * @param string $path
	 * @param string $controller
	 * @param string|null $method
	 * @param array $options
	 */
	public function delete(string $path, string $controller, string $method = null, array $options = []): void
	{
		$route = new Route($path, $controller, $method, [RouteInterface::METHOD_DELETE], $options);
		$this->applyOptions($route, $options);
		$this->applyGroupOptions($route);
		$this->routes[] = $route;
	}

	/**
	 * @param string $resource
	 * @param string $controller
	 * @param array $options
	 */
	public function resource(string $resource, string $controller, array $options = []): void
	{
		$this->get('/' . $resource, $controller, 'index');
		$options = array_merge([
			'patterns' => [
				'id' => '\d+'
			]
		], $options);
		$this->get('/' . $resource . '/{id}', $controller, 'show', $options);
		$this->post('/' . $resource, $controller, 'create');
		$this->patch('/' . $resource . '/{id}', $controller, 'edit', $options);
		$this->delete('/' . $resource . '/{id}', $controller, 'delete', $options);
	}

	/**
	 * @param array $options
	 * @param callable $group
	 */
	public function group(array $options, callable $group): void
	{
		$this->addGroupOptions($options);
		$group();
		$this->removeGroupOptions();
	}

	/**
	 * @param string $controller
	 * @param string|null $method
	 * @param array $options
	 */
	public function fallback(string $controller, string $method = null, array $options = []): void
	{
		$route = new Route('', $controller, $method, RouteInterface::METHODS_ALL, $options);
		$this->applyOptions($route, $options);
		$this->fallbackRoute = $route;
	}

	/**
	 * @param array $options
	 */
	private function addGroupOptions(array $options): void
	{
		$this->currentGroupOptions[] = $options;
	}

	private function removeGroupOptions(): void
	{
		array_shift($this->currentGroupOptions);
	}

	/**
	 * @param Route $route
	 * @param array $options
	 */
	private function applyOptions(Route $route, array $options): void
	{
		if (isset($options['protectors'])) {
			$route->addProtectors($options['protectors']);
		}
	}

	/**
	 * @param RouteInterface $route
	 */
	private function applyGroupOptions(RouteInterface $route): void
	{
		$options = array_reverse($this->currentGroupOptions);
		foreach ($options as $option) {
			if (isset($option['prefix'])) {
				$route->addPrefix($option['prefix']);
			}
			if (isset($option['protectors'])) {
				$route->addProtectors($option['protectors']);
			}
		}
	}

	/**
	 * @throws RoutesAlreadyLoadedException
	 */
	public function boot(): void
	{
		$this->loadRoutes();
	}
}