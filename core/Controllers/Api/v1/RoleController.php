<?php declare(strict_types=1);

namespace Core\Controllers\Api\v1;

use Core\Controllers\Api\ApiController;
use Core\Entity\Role;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoleController extends ApiController
{

	/**
	 * @var EntityManager
	 */
	protected EntityManager $entityManager;

	/**
	 * @param EntityManager $entityManager
	 */
	public function __construct(EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	/**
	 * @return JsonResponse
	 */
	public function index(): JsonResponse
	{
		return new JsonResponse($this->entityManager->getRepository(Role::class)->findAll());
	}

	/**
	 * @param int $id
	 * @return JsonResponse
	 */
	public function show(int $id): JsonResponse
	{
		return new JsonResponse($this->entityManager->getRepository(Role::class)->find($id));
	}

	/**
	 * @return JsonResponse
	 */
	public function create(): JsonResponse
	{
		return new JsonResponse('Ok');
	}

	/**
	 * @param int $id
	 * @return JsonResponse
	 */
	public function edit(int $id): JsonResponse
	{
		return new JsonResponse('Ok');
	}

	/**
	 * @param int $id
	 * @return JsonResponse
	 */
	public function delete(int $id): JsonResponse
	{
		return new JsonResponse('Ok');
	}

}