<?php declare(strict_types=1);

namespace Core\EventListeners;

use Core\Application;
use Core\Common\EventsService\EventInterface;
use Core\Common\EventsService\EventListener;
use Core\Common\PerformanceRecorderService\PerformanceRecordingException;
use Core\Components\ServiceContainer\Exceptions\ServiceIsNotExistsException;
use Core\Services\PerformanceRecorderService;

class StartPerformanceRecordListener extends EventListener
{

	/**
	 * @param EventInterface $event
	 * @throws PerformanceRecordingException
	 * @throws ServiceIsNotExistsException
	 */
	public function handle(EventInterface $event): void
	{
		/** @var PerformanceRecorderService $performanceRecorder */
		$performanceRecorder = Application::getInstance()->getServiceContainer()->getService(PerformanceRecorderService::class);
		$performanceRecorder->startRecord();
	}
}