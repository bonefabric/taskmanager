<?php declare(strict_types=1);

namespace Core\Events;

use Core\Common\EventsService\Event;
use Core\EventListeners\FinishPerformanceRecordListener;

class AfterFinishEvent extends Event
{

	/**
	 * @var string[]
	 */
	protected array $listeners = [
//		FinishPerformanceRecordListener::class,
	];

}