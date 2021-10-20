<?php

namespace Core\Components\DIContainer;

interface DIObjectInterface
{

	/**
	 * @return object
	 */
	public function get(): object;

}