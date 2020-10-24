<?php

namespace App;

use App\Models\Schedule;
use App\Models\Studio;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
	protected $guarded = [];

	protected $casts = [
		'start_date' => 'datetime',
		'end_date' => 'datetime',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function studio()
	{
		return $this->belongsTo(Studio::class);
	}

	public function schedule()
	{
		return $this->belongsTo(Schedule::class);
	}
}
