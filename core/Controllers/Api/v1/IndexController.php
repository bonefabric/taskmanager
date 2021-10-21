<?php declare(strict_types=1);

namespace Core\Controllers\Api\v1;

use Core\Controllers\Api\ApiController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends ApiController
{

	/**
	 * @return Response
	 */
	public function index(): Response
	{
		return new Response('testing rwa');
	}

}