<?php declare(strict_types=1);

namespace Core\Components\Router;

use Symfony\Component\HttpFoundation\Request;

interface RouteInterface
{

	public const METHOD_GET = 'GET';
	public const METHOD_POST = 'POST';
	public const METHOD_PUT = 'PUT';
	public const METHOD_PATCH = 'PATCH';
	public const METHOD_DELETE = 'DELETE';

	public const METHODS_ALL = [
		self::METHOD_GET,
		self::METHOD_POST,
		self::METHOD_PUT,
		self::METHOD_PATCH,
		self::METHOD_DELETE
	];
	/**
	 * @param Request $request
	 * @return bool
	 */
	public function check(Request $request): bool;

	/**
	 * @return string
	 */
	public function getPath(): string;

	/**
	 * @return string
	 */
	public function getController(): string;

	/**
	 * @return string
	 */
	public function getControllerMethod(): string;

	/**
	 * @return string[]
	 */
	public function getMethods(): array;

	/**
	 * @return string[]
	 */
	public function getOptions(): array;

	/**
	 * @return array
	 */
	public function getParams(): array;
}