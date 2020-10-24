<?php

namespace App\Http\Controllers;

use App\Repositories\ScheduleRepository;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookingController extends Controller
{
	private $bookingService;
	private $scheduleRepository;

	/**
	 * BookingController constructor.
	 * @param BookingService $bookingService
	 * @param ScheduleRepository $scheduleRepository
	 */
	public function __construct(BookingService $bookingService, ScheduleRepository $scheduleRepository ) {

		$this->bookingService = $bookingService;
		$this->scheduleRepository = $scheduleRepository;
	}

	/**
	 * Show the application dashboard.
	 *
	 * @param Request $request
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function bookSession(Request $request)
	{
		$user = $request->user();

		$schedule = $this->scheduleRepository->findByScheduleId($request->schedule);

		try {
			$this->bookingService->join($user, $schedule);

			return response()->json([
				'message'       => 'User joined successfully',
				'response'      => true,
			], Response::HTTP_OK);

		} catch (\Exception $exception) {

			return response()->json([
				'message'       => 'User unable to join',
				'response'      => false,
				'error' => $exception->getMessage()
			], Response::HTTP_OK);
		}

	}

	/**
	 * Show the application dashboard.
	 *
	 * @param Request $request
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function leaveSession(Request $request)
	{
		$user = $request->user();
		$scheduleId = $request->scheduleId;
		try {
			$this->bookingService->leave($user, $scheduleId);

			return response()->json([
				'message'       => 'User left session successfully',
				'response'      => true,
			], Response::HTTP_OK);
		} catch (\Exception $exception) {

			return response()->json([
				'message'       => 'User unable to leave Session',
				'response'      => false,
				'error' => $exception->getMessage()
			], Response::HTTP_OK);
		}
	}
}
