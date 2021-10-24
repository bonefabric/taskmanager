<?php declare(strict_types=1);

namespace Core\Common\Doctrine;

use DateTime;

trait SoftDeletes
{

	public function softDelete(): void
	{
		$this->deleted_at = new DateTime();
	}

}