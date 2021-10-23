<?php declare(strict_types=1);

namespace Core;

use Core\Components\ServiceContainer\ServiceContainer;
use Core\Services\DIService;
use Symfony\Component\HttpFoundation\Response;

//TODO кэширование конфигураций
final class Application
{

	/**
	 * @var Application
	 */
	private static Application $instance;

//	/**
//	 * @var DIContainer
//	 */
//	private DIContainer $container;

	/**
	 * @var Response
	 */
	private Response $response;

	/**
	 * @var ServiceContainer
	 */
	private ServiceContainer $serviceContainer;

	private function __construct()
	{
		if (!defined('ROOT_PATH')) {
			define('ROOT_PATH', dirname(__DIR__));
		}
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

	/**
	 * @throws Components\ServiceContainer\Exceptions\ServicesAlreadyLoadedException
	 */
	public function init(): void
	{
		require_once ROOT_PATH . '/bootstrap/bootstrap.php';

		$this->serviceContainer = new Components\ServiceContainer\ServiceContainer();
		$this->serviceContainer->loadServices();

		/** @var DIService $DI */
		$DI = $this->serviceContainer->getService(DIService::class);

//		$this->container->bindSingleton(new Defender());
//		$this->container->bindSingleton(EntityManager::create([
//			'driver' => 'pdo_' . $_ENV['DRIVER'],
//			'dbname' => $_ENV['DB_NAME'],
//			'host' => $_ENV['DB_HOST'],
//			'user' => $_ENV['DB_USER'],
//			'password' => $_ENV['DB_PASSWORD']
//		], Setup::createAnnotationMetadataConfiguration([ROOT_PATH . '/core/Entity'], $_ENV['DEBUG'] === 'true', null, null, false)));
//
//		$routes = include ROOT_PATH . '/config/routes.php';
//		foreach ($routes as $route) {
//			require_once $route;
//		}
	}

	public function start(): void
	{
//		/** @var RouteInterface $route */
//		$route = $this->container->get(Router::class)->handle($this->container->get(Request::class));
//		if (is_null($route)) {
//			$this->response = new Response(Template::getTemplate('errors.404'), 404);
//			return;
//		}
//
//		/** @var Defender $defender */
//		$defender = $this->container->get(Defender::class);
//		if (!$defender->checkRoute($route)) {
//			$this->response = new Response(Template::getTemplate('errors.401'), 401);
//			return;
//		}
//
//		$controllerClass = $route->getController();
//		$constructor = (new \ReflectionClass($controllerClass))->getConstructor();
//		$options = [];
//		if (!is_null($constructor)) {
//			foreach ($constructor->getParameters() as $parameter) {
//				is_null($parameter->getType()) ?: $options[$parameter->getPosition()] = $this->container->get($parameter->getType()->getName());
//			}
//		}
//		$controller = new $controllerClass(...$options);
//		$this->response = $controller->{$route->getControllerMethod()}(...array_values($route->getParams()));
	}

	public function finish(): void
	{
		dump($this->serviceContainer);
		$this->serviceContainer->downProviders();
//		$this->response->send();
	}

}