<?php declare(strict_types=1);

namespace Core\Controllers\Api\v1;

use Core\Components\Helpers\Template;
use Core\Controllers\Api\ApiController;
use Core\Entity\Role;
use Core\Entity\User;
use Core\Repository\RoleRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends ApiController
{

	/**
	 * @var Request
	 */
	protected Request $request;

	protected EntityManager $entityManager;

	/**
	 * @param Request $request
	 * @param EntityManager $entityManager
	 */
	public function __construct(Request $request, EntityManager $entityManager)
	{
		$this->request = $request;
		$this->entityManager = $entityManager;
	}

	/**
	 * @return Response
	 */
	public function index(): Response
	{

		/** @var Role $role */
		$role = $this->entityManager->find(Role::class, 2);

		$user = new User();
		$user->setName('Insaf');
		$user->setEmail('iburanguloff@ya.ru');
		$user->setPassword('testpassword');
		$user->setRoleRef($role->getId());
		$this->entityManager->persist($user);
		$this->entityManager->flush();

		return new Response(Template::getTemplate('index'));
	}
}