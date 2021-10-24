<?php declare(strict_types=1);

namespace Core\ServiceProviders;

use Core\Application;
use Core\Common\PerformanceRecorderService\PerformanceRecordingException;
use Core\Components\ServiceContainer\Exceptions\ServiceIsNotExistsException;
use Core\Components\ServiceContainer\ServiceProvider;
use Core\Services\PerformanceRecorderService;
use Symfony\Component\HttpFoundation\Response;

class PerformanceRecorderServiceProvider extends ServiceProvider
{

	public function up(): void
	{
		$this->register(new PerformanceRecorderService(), true);
	}

	/**
	 * @param Response $response
	 * @throws PerformanceRecordingException
	 * @throws ServiceIsNotExistsException
	 */
	public function down(Response $response): void
	{
		if ($_ENV['DEBUG']) {
			/** @var PerformanceRecorderService $performanceService */
			$performanceService = Application::getInstance()->getServiceContainer()->getService(PerformanceRecorderService::class);

			$performance = $performanceService->getPerformance();
			$response->headers->add(['X-Performance' => $performance->s + $performance->f]);
		}
	}
}