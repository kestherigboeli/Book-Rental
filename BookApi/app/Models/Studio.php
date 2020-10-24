<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
	use Sluggable;

	protected $guarded = [];

	// /**
	//  * The relations to eager load on every query.
	//  *
	//  * @var array
	//  */
	// protected $with = [
	//     'config'
	// ];

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

	public function config()
	{
		return $this->hasOne(StudioConfig::class);
	}

	/**
	 * Get all of the posts that are assigned this tag.
	 */
	public function users()
	{
		return $this->belongsToMany(User::class)->withTimestamps();
	}

	/**
	 * Get all of the posts that are assigned this tag.
	 */
	public function activities()
	{
		return $this->hasMany(Activity::class);
	}

	/**
	 * Get all of the posts that are assigned this tag.
	 */
	public function bookings()
	{
		return $this->hasMany(Booking::class);
	}

	/**
	 * Get all of the posts that are assigned this tag.
	 */
	public function facilities()
	{
		return $this->hasMany(Facility::class);
	}

}
