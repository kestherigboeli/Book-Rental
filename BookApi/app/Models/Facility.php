<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
	use Sluggable;

	protected $guarded = [];

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

	/**
	 * Get all of the posts that are assigned this tag.
	 */
	public function studio()
	{
		return $this->belongsTo(Studio::class);
	}
}
