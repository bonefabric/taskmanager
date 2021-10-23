<?php declare(strict_types=1);

namespace Core\ServiceProviders;

use Core\Application;
use Core\Components\ServiceContainer\Exceptions\ServiceIsNotExistsException;
use Core\Services\CSRFService;
use Symfony\Component\HttpFoundation\Response;

class CSRFServiceProvider extends BaseServiceProvider
{

	public function up(): void
	{
		$this->register(new CSRFService(), true);
	}

	/**
	 * @param Response $response
	 * @throws ServiceIsNotExistsException
	 */
	public function down(Response $response): void
	{
		/** @var CSRFService $CSRFService */
		$CSRFService = Application::getInstance()->getServiceContainer()->getService(CSRFService::class);
		$CSRFService->addResponseToken($response);
	}
}