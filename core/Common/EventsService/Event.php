<?php declare(strict_types=1);

namespace Core\Common\EventsService;

abstract class Event implements EventInterface
{

	/**
	 * @var string[]
	 */
	protected array $listeners = [];


	/**
	 * @throws InvalidListenerException
	 */
	public function dispatch(): void
	{
		foreach ($this->listeners as $listenerClass) {
			$listener = new $listenerClass();
			if (!$listener instanceof EventListenerInterface) {
				throw new InvalidListenerException('Event listener must implement Core\Common\EventsService\EventListenerInterface.');
			}
			$listener->handle($this);
		}
	}
}