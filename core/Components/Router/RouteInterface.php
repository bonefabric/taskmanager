<?php

namespace Core\Components\Router;

interface RouteInterface
{

	public function getController(): string;

	public function getName(): ?string;

}