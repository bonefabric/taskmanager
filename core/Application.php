<?php declare(strict_types=1);

namespace Core;

use Core\Common\RouterService\RouteInterface;
use Core\Components\Helpers\Template;
use Core\Components\ServiceContainer\ServiceContainer;
use Core\Services\DefenderService;
use Core\Services\DIService;
use Core\Services\RouterService;
use ReflectionException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//TODO кэширование конфигураций
final class Application
{

	/**
	 * @var Application
	 */
	private static Application $instance;

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
	 * @return ServiceContainer
	 */
	public function getServiceContainer(): ServiceContainer
	{
		return $this->serviceContainer;
	}

	/**
	 * @throws Components\ServiceContainer\Exceptions\ServicesAlreadyLoadedException
	 */
	public function init(): void
	{
		require_once ROOT_PATH . '/bootstrap/bootstrap.php';

		$this->serviceContainer = new ServiceContainer();
		$this->serviceContainer->loadServices();
	}

	/**
	 * @throws Common\RouterService\Exceptions\RoutesAlreadyLoadedException
	 * @throws Components\ServiceContainer\Exceptions\ServiceIsNotExistsException
	 * @throws ReflectionException
	 */
	public function start(): void
	{
		/** @var RouterService $router */
		$router = $this->serviceContainer->getService(RouterService::class);

		/** @var Request $request */
		$request = $this->serviceContainer->getService(Request::class);

		/** @var RouteInterface $route */
		$route = $router->handle($request);

		if (is_null($route)) {
			$this->response = new Response(Template::getTemplate('errors.404'), 404);
			return;
		}

		/** @var DefenderService $defender */
		$defender = $this->getServiceContainer()->getService(DefenderService::class);

		if (!$defender->accessed()) {
			$this->response = new Response(Template::getTemplate('errors.403'), 403);
			return;
		}

		$controllerClass = $route->getController();

		/** @var DIService $DIService */
		$DIService = $this->serviceContainer->getService(DIService::class);
		$constructorOptions = $DIService->getConstructorParams($controllerClass);

		$options = $this->serviceContainer->getServicesArray($constructorOptions);

		$controller = new $controllerClass(...$options);
		$this->response = $controller->{$route->getControllerMethod()}(...array_values($route->getParams()));
	}

	public function finish(): void
	{
		$this->serviceContainer->downProviders();
		$this->response->send();
	}

}