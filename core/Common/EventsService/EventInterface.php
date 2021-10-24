<?php declare(strict_types=1);

namespace Core\Common\EventsService;

interface EventInterface
{

	public function dispatch(): void;

}