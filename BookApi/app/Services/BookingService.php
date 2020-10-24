<?php

namespace App\Services;


use App\Repositories\BookingRepository;
use App\Repositories\ScheduleRepository;

class BookingService
{
	protected $schedule;
	protected $bookingRepository;

	public function __construct(ScheduleRepository $schedule, BookingRepository $bookingRepository)
	{
		$this->schedule = $schedule;
		$this->bookingRepository = $bookingRepository;
	}

	public function isAlreadyBooked($user, $scheduleId)
	{
		return $this->bookingRepository->isAlreadyBooked($user, $scheduleId);
	}

	public function isSpaceAvailable($scheduleId)
	{
		return $this->schedule->isSpaceAvailable($scheduleId);
	}

	/**
	 * @param $user
	 * @param $schedule
	 */
	public function addToSchedule($user, $schedule)
	{
		$booked = $this->bookingRepository->findByUserIdAndScheduleId($user, $schedule);

		$schedule = $this->schedule->findByScheduleId($schedule->id);

		if ($booked) {
			$this->bookingRepository->findByUserIdAndScheduleId($user, $schedule)
				->update([
					'status' => config('enums.booking_status.Confirmed')
				]);

		} else {
			$this->bookingRepository->createBooking($user, $schedule, $waiting = false);

			$schedule->decrement('available', 1);
		}

	}

	/**
	 * @param $user
	 * @param $schedule
	 */
	public function addToWaitingList($user, $schedule)
	{
		$booked = $this->bookingRepository->findByUserIdAndScheduleId($user, $schedule);

		$schedule = $this->schedule->findByScheduleId($schedule->id);

		if ($booked) {

			$this->bookingRepository->findByUserIdAndScheduleId($user, $schedule)
				->update([
					'status' => config('enums.booking_status.Pending')
				]);

		} else {

			$this->bookingRepository->createBooking($user, $schedule, $waiting = true);

		}
	}

	/**
	 * @param $user
	 * @param $schedule
	 *
	 *
	 */
	public function join($user, $schedule)
	{
		if (!$user->sanctioned_until) {
			if ($user->subscribed() || $user->pretrial || $user->onTrial() || $user->status = config( 'enums.user_status.Active' )) {
				if (!$this->isAlreadyBooked( $user, $schedule->id )) {
					if ($this->isSpaceAvailable( $schedule->id )) {
						$this->addToSchedule( $user, $schedule );
					} else {
						$this->addToWaitingList( $user, $schedule );
					}
				} else {
					if ($this->isSpaceAvailable( $schedule->id )) {
						$this->addToSchedule( $user, $schedule );
					} else {
						$this->addToWaitingList( $user, $schedule );
					}
				}
			}
		}
	}

	/**
	 * Show the application dashboard.
	 *
	 * @param $user
	 * @param $scheduleId
	 * @throws \Exception
	 */
	public function leave($user, $scheduleId)
	{

		$schedule = $this->schedule->findByScheduleId($scheduleId);

		$dbtimestamp = strtotime($schedule->start_date);

		if ($this->checkIfTimeHasPassed($dbtimestamp)) {

			throw new \Exception('Time have passed for customer to cancel');

		} else {

			$userBooking = $this->bookingRepository->findByUserIdAndScheduleId($user, $schedule);

			if ($userBooking) {

				// delete the booking
				$delete = $userBooking->delete();

				if ($delete) {

					$checkWaiting =  $this->bookingRepository->findByScheduleIdAndStatusOrderByASC($schedule);

					$checkUserIsWaiting = $this->bookingRepository->findByUserIdScheduleIdAndStatus($schedule, $user);

					$checkAllBooking = $this->bookingRepository->findByScheduleIdAndStatus($schedule);

					if (count($checkWaiting) > 0 && !$checkUserIsWaiting) {

						// bump a pending using to the session
						if (count($checkAllBooking) < $schedule->capacity) {
							$checkWaiting->first()->update([
								'status' => config('enums.booking_status.Confirmed')
							]);
						}
					}

					$checkAllBooking = $this->bookingRepository->findByScheduleIdAndStatus($schedule);

					// Update availability
					if (count($checkAllBooking) < $schedule->capacity) {
						$schedule->update([
							'available' => $schedule->available + 1
						]);
					}
				}

			} else {
				throw new \Exception('Unable to remove user from session');
			}
		}
	}


	private function checkIfTimeHasPassed($dbtimestamp) {

		return (!time() - $dbtimestamp > 60 * 60);
	}
}