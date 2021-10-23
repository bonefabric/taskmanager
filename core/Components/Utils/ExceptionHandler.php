<?php declare(strict_types=1);

namespace Core\Components\Utils;

use Core\Components\Helpers\Template;
use Symfony\Component\HttpFoundation\Response;

class ExceptionHandler
{

	public static function init(): void
	{
		set_exception_handler(static function (\Throwable $exception) {
			if ($_ENV['DEBUG'] !== 'true') {
				(new Response(Template::getTemplate('errors.500')))->send();
				return;
			}
			dump($exception);
		});
	}

}