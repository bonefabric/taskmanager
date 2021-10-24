<?php declare(strict_types=1);

namespace Core\Common\EventsService;

interface EventListenerInterface
{

	/**
	 * @param EventInterface $event
	 */
	public function handle(EventInterface $event): void;

}