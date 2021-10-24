<?php declare(strict_types=1);

namespace Core\Services;

use Core\Common\PerformanceRecorderService\PerformanceRecordingException;
use DateInterval;
use DateTime;

final class PerformanceRecorderService
{

	/**
	 * @var DateTime
	 */
	private DateTime $started_at;

	/**
	 * @var DateTime
	 */
	private DateTime $finished_at;

	/**
	 * @var DateInterval
	 */
	private DateInterval $performance;

	/**
	 * @var bool
	 */
	private bool $recording = false;

	/**
	 * @var bool
	 */
	private bool $recorded = false;

	/**
	 * @throws PerformanceRecordingException
	 */
	public function startRecord(): void
	{
		if ($this->recording || $this->recorded) {
			throw new PerformanceRecordingException('Performance recording is not finished or already finished.');
		}
		$this->recording = true;
		$this->started_at = new DateTime();
	}

	public function finishRecord(): void
	{
		$this->finished_at = new DateTime();
		$this->recording = false;
		$this->recorded = true;
	}

	/**
	 * @return DateInterval
	 * @throws PerformanceRecordingException
	 */
	public function getPerformance(): DateInterval
	{
		if (!$this->recorded) {
			throw new PerformanceRecordingException('No performance check has been performed');
		}
		return $this->started_at->diff($this->finished_at);
	}

}