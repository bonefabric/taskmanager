<?php declare(strict_types=1);

namespace Core\ServiceProviders;

use Core\Application;
use Core\Components\ServiceContainer\Exceptions\ServiceIsNotExistsException;
use Core\Components\ServiceContainer\ServiceProvider;
use Core\Services\CSRFService;
use Symfony\Component\HttpFoundation\Response;

final class CSRFServiceProvider extends ServiceProvider
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