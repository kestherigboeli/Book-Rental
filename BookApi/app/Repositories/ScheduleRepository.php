<?php
/**
 * Created by PhpStorm.
 * User: kesterigboeli
 * Date: 24/10/2020
 * Time: 14:30
 */

namespace App\Repositories;

use MrAtiebatie\Repository;

class ScheduleRepository
{
	use Repository;

	/**
	 * The model being queried.
	 *
	 * @var Model
	 */
	protected $model;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->model = app(\App\Models\Schedule::class);
	}

	/**
	 * @param $scheduleId
	 *
	 * @return mixed
	 */
	public function isSpaceAvailable($scheduleId)
	{
		return $this->model
			->where('id', $scheduleId)
			->where('available', '>', 0)
			->first();
	}

	/**
	 * @param $scheduleId
	 *
	 * @return mixed
	 */
	public function findByUserIdAndScheduleId($scheduleId)
	{
		return $this->model
			->where('id', $scheduleId)
			->where('available', '>', 0)
			->first();
	}

	/**
	 * @param $scheduleId
	 *
	 * @return mixed
	 */
	public function findByScheduleId($scheduleId)
	{
		return $this->model
			->where('id', $scheduleId)
			->first();
	}
}