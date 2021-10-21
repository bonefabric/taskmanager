<?php declare(strict_types=1);

namespace Core\Components\Helpers;

final class Template
{

	/**
	 * @param string $name
	 * @return string
	 */
	public static function getTemplate(string $name): string
	{
		return file_get_contents(implode(DIRECTORY_SEPARATOR, [
			ROOT_PATH,
			'resources',
			'templates',
			str_replace('.', DIRECTORY_SEPARATOR, $name) . '.template.html'
		]));
	}

}