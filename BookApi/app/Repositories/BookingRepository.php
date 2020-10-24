<?php

namespace App\Repositories;


class BookingRepository
{
	use Repository;

	/**
	 * The model being queried.
	 *
	 * @var \Illuminate\Database\Eloquent\Model
	 */
	protected $model;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->model = app(Booking::class);
	}

	public function isAlreadyBooked($user, $scheduleId)
	{
		return $this->model->where('user_id', $user->id)
			->where('schedule_id', $scheduleId)
			->first();
	}

	public function isAlreadyTopOnWaitingList($scheduleId)
	{
		return $this->model->with(['user'])
			->where('schedule_id', $scheduleId)
			->where('status', config('enums.booking_status.Pending'))
			->first();
	}

	/**
	 * @param $schedule
	 * @param $user
	 * @return mixed
	 */
	public function findByUserIdAndScheduleId($user, $schedule)
	{
		return $this->model
			->where('schedule_id', $schedule->id)
			->where('user_id', $user->id)
			->first();
	}

	public function findByScheduleIdAndStatusOrderByASC($schedule)
	{
		return $this->model
			->where('schedule_id', $schedule->id)
			->where('status', config('enums.booking_status.Pending'))
			->orderBy('created_at', 'asc')
			->get();
	}

	/**
	 * @param $schedule
	 * @param $user
	 * @return mixed
	 */
	public function findByUserIdScheduleIdAndStatus($schedule, $user)
	{
		return $this->model
			->where('schedule_id', $schedule->id)
			->where('user_id', $user->id)
			->where('status', config('enums.booking_status.Pending'))
			->first();
	}

	public function findByScheduleIdAndStatus($schedule)
	{
		return $this->model
			->where('schedule_id', $schedule->id)
			->where('status', config('enums.booking_status.Confirmed'))
			->get();
	}

	/**
	 * @param $user
	 * @param $schedule
	 * @param bool $waiting
	 * @return mixed
	 */
	public function createBooking($user, $schedule, $waiting = false)
	{
		return $this->model->create([
			'user_id'       => $user->id,
			'schedule_id'   => $schedule->id,
			'studio_id'     => $schedule->studio_id,
			'start_date'    => $schedule->start_date,
			'end_date'      => $schedule->end_date,
			'status'        => $waiting ? config('enums.booking_status.Pending') : config('enums.booking_status.Confirmed'),
		]);
	}
}