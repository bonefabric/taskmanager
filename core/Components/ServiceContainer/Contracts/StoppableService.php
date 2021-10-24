<?php declare(strict_types=1);

namespace Core\Components\ServiceContainer\Contracts;

/**
 * Stoppable service uses in singleton services
 */
interface StoppableService
{

	public function stop(): void;

}