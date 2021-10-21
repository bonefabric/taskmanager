<?php declare(strict_types=1);

namespace Core;

use Core\Components\DIContainer\DIContainer;
use Core\Components\Router\RouteInterface;
use Core\Components\Router\Router;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class Application
{

	/**
	 * @var Application
	 */
	private static Application $instance;

	/**
	 * @var DIContainer
	 */
	private DIContainer $container;

	/**
	 * @var Response
	 */
	private Response $response;

	private function __construct()
	{
	}

	/**
	 * @return Application
	 */
	public static function getInstance(): Application
	{
		if (!isset(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function init(): void
	{
		require_once ROOT_PATH . '/bootstrap/bootstrap.php';
		$this->container = new DIContainer();
		$this->container->bindSingleton(Request::createFromGlobals());
		$this->container->bindSingleton(new Router());
		$this->container->bindSingleton(EntityManager::create([
			'driver' => 'pdo_' . $_ENV['DRIVER'],
			'dbname' => $_ENV['DB_NAME'],
			'host' => $_ENV['DB_HOST'],
			'user' => $_ENV['DB_USER'],
			'password' => $_ENV['DB_PASSWORD']
		], Setup::createAnnotationMetadataConfiguration([ROOT_PATH . '/core/Entity'], $_ENV['DEBUG'] === 'true', null, null, false)));

		$routes = include ROOT_PATH . '/config/routes.php';
		foreach ($routes as $route) {
			require_once $route;
		}
	}

	/**
	 * @throws \ReflectionException
	 */
	public function start(): void
	{
		/** @var RouteInterface $route */
		$route = $this->container->get(Router::class)->handle($this->container->get(Request::class));
		$controllerClass = $route->getController();
		$constructor = (new \ReflectionClass($controllerClass))->getConstructor();
		$options = [];
		if (!is_null($constructor)) {
			foreach ($constructor->getParameters() as $parameter) {
				is_null($parameter->getType()) ?: $options[$parameter->getPosition()] = $this->container->get($parameter->getType()->getName());
			}
		}
		$controller = new $controllerClass(...$options);
		$this->response = $controller->{$route->getControllerMethod()}(...array_values($route->getParams()));
	}

	public function finish(): void
	{
		$this->response->send();
	}

	/**
	 * @param string $class
	 * @return object|null
	 */
	public function getComponent(string $class): ?object
	{
		return $this->container->get($class);
	}

}