<?php declare(strict_types=1);

namespace Core\Controllers\Api\v1;

use Core\Controllers\Api\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends ApiController
{

	/**
	 * @var Request
	 */
	protected Request $request;

	/**
	 * @param Request $request
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * @return Response
	 */
	public function index(): Response
	{
		return new JsonResponse('testing rwa');
	}

	/**
	 * @param int $id
	 * @return Response
	 */
	public function users(int $id): Response
	{
		return new JsonResponse('id ' . $id);
	}

}