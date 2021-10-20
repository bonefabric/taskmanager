<?php declare(strict_types=1);

namespace Core;

use Core\Components\DIContainer;
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
	}

	public function start(): void
	{
	}

	public function finish(): void
	{
		(new Response('test'))->send();
	}

}