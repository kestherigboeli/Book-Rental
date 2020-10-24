<?php

namespace App\Models;

use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
	use Sluggable;

	protected $guarded = [];

	protected $appends = [
		'start_time',
		'finish_time',
		'display_date',
		'has_time_past'
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'start_date' => 'datetime',
		'end_date' => 'datetime',
	];

	/**
	 * Return the sluggable configuration array for this model.
	 *
	 * @return array
	 */
	public function sluggable()
	{
		return [
			'slug' => [
				'source' => 'name'
			]
		];
	}

//	public function getStartTimeAttribute()
//	{
//		return $this->start_date->isoFormat('h:mma');
//	}
//
//	public function getDisplayDateAttribute()
//	{
//		return $this->start_date->format('Y-m-d');
//	}
//
//	public function getFinishTimeAttribute()
//	{
//		return $this->end_date->isoFormat('h:mma');
//	}
//
//	public function getHasTimePastAttribute()
//	{
//		$diff = $this->end_date->diffInHours(now(), false);
//
//		return $diff >= 1;
//	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function trainer()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function studio()
	{
		return $this->belongsTo(Studio::class, 'studio_id');
	}

	public function facility()
	{
		return $this->belongsTo(Facility::class, 'facility_id');
	}

	public function bookings()
	{
		return $this->belongsToMany(User::class, 'bookings', 'event_id', 'user_id')
			->withPivot([ 'status']);
	}
}
