<?php declare(strict_types=1);

/**
 * Список поседников
 */
return [
	'protectors' => [
		'auth' => \Core\Protectors\AuthProtector::class,
		'throttle' => \Core\Protectors\ThrottleProtector::class,
		'csrf' => \Core\Protectors\CSRFProtector::class,
	],
];