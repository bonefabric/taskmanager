<?php declare(strict_types=1);

namespace Core\Controllers\Api\v1;

use Core\Controllers\Api\ApiController;
use Core\Entity\Task;
use Core\Facades\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TasksController extends ApiController
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
		return new JsonResponse(EntityManager::component()->getRepository(Task::class)->findAll());
		//TODO пагинация
	}

	/**
	 * @param int $id
	 * @return Response
	 */
	public function show(int $id): Response
	{
		return new JsonResponse(EntityManager::component()->getRepository(Task::class)->find($id));
	}

	/**
	 * @return Response
	 */
	public function create(): Response
	{
		return new JsonResponse('create');
	}

	/**
	 * @param int $id
	 * @return Response
	 */
	public function edit(int $id): Response
	{
		return new JsonResponse('edit ' . $id);
	}

	/**
	 * @param int $id
	 * @return Response
	 */
	public function delete(int $id): Response
	{
		return new JsonResponse('delete ' . $id);
	}

}