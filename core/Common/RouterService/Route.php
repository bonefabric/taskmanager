<?php declare(strict_types=1);

namespace Core\Common\RouterService;

use Core\Common\DefenderService\ProtectorInterface;
use Symfony\Component\HttpFoundation\Request;

class Route implements RouteInterface
{

	/**
	 * @var string[]
	 */
	protected array $protectors = [];

	/**
	 * Regex for comparing with URI
	 * @var string
	 */
	protected string $path;

	/**
	 * Route handler class
	 * @var string
	 */
	protected string $controller;

	/**
	 * Supported methods
	 * @var string[]
	 */
	protected array $methods;

	/**
	 * Router handler controller method
	 * @var string
	 */
	protected string $controllerMethod;

	/**
	 * Route options(patterns and other)
	 * @var array
	 */
	protected array $options;

	/**
	 * Dynamic params
	 * @var array
	 */
	protected array $params = [];


	/**
	 * @param string $path
	 * @param string $controller
	 * @param string $controllerMethod
	 * @param array $methods
	 * @param array $options
	 */
	public function __construct(string $path, string $controller, string $controllerMethod, array $methods, array $options = [])
	{
		$this->path = trim($path, '/');
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
		return $this->checkOptions(trim($request->server->get('REQUEST_URI'), '/')) || $this->compare($request);
	}

	/**
	 * @param string $uri
	 * @return bool
	 */
	protected function checkOptions(string $uri): bool
	{
		if (empty($this->options['patterns'])) {
			return false;
		}

		$uriParts = explode('/', $uri);
		$pathParts = explode('/', $this->path);

		$count = count($uriParts);

		if ($count !== count($pathParts)) {
			return false;
		}

		for ($i = 0; $i < $count; $i++) {
			$uriPart = $uriParts[$i];
			$pathPart = $pathParts[$i];

			if ($uriPart === $pathPart) {
				continue;
			}

			$key = trim($pathPart, '{}');
			if (empty($this->options['patterns'][$key])) {
				continue;
			}

			if (preg_match('~^' . $this->options['patterns'][$key] . '$~', $uriPart)) {
				$this->params[$key] = is_numeric($uriPart) ? (int)$uriPart : $uriPart;
				continue;
			}
			return false;
		}
		$this->path = $uri;
		return true;
	}

	/**
	 * @param Request $request
	 * @return bool
	 */
	protected function compare(Request $request): bool
	{
		//TODO regex
		return trim($request->server->get('REQUEST_URI'), '/') === $this->path
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

	/**
	 * @return array
	 */
	public function getParams(): array
	{
		return $this->params;
	}

	/**
	 * @param string $prefix
	 */
	public function addPrefix(string $prefix): void
	{
		$this->path = trim($prefix, '/') . '/' . $this->path;
	}

	/**
	 * @return ProtectorInterface[]
	 */
	public function getProtectors(): array
	{
		return $this->protectors;
	}

	/**
	 * @param string $protector
	 */
	public function addProtector(string $protector): void
	{
		$this->protectors[] = $protector;
	}

	/**
	 * @param array $protectors
	 */
	public function addProtectors(array $protectors): void
	{
		foreach ($protectors as $protector) {
			$this->addProtector($protector);
		}
	}
}