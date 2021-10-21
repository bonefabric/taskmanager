<?php declare(strict_types=1);

namespace Core\Controllers\Api\v1;

use Core\Components\Helpers\Template;
use Core\Controllers\Api\ApiController;
use Core\Entity\Task;
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
		return new Response(Template::getTemplate('index'));
	}
}