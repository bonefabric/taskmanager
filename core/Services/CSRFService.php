<?php declare(strict_types=1);

namespace Core\Services;

use Symfony\Component\HttpFoundation\Response;

final class CSRFService
{

	/**
	 * @param Response $response
	 */
	public function addResponseToken(Response $response): void
	{
		$response->headers->add(['CSRFToken' => 'none']);
	}

}