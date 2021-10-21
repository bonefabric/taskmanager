<?php

namespace Core\Components\Router;

final class Route implements RouteInterface
{

	public function getController(): string
	{
		return 'test';
	}

	public function getName(): ?string
	{
		return null;
	}
}