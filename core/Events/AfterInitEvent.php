<?php declare(strict_types=1);

namespace Core\Events;

use Core\Common\EventsService\Event;
use Core\EventListeners\StartPerformanceRecordListener;

class AfterInitEvent extends Event
{

	/**
	 * @var string[]
	 */
	protected array $listeners = [
//		StartPerformanceRecordListener::class,
	];

}