<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
	protected $guarded = [];

	/**
	 * Get all of the users.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * Get all of the users.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function studio()
	{
		return $this->belongsTo(Studio::class);
	}

	/**
	 * Get all of the users.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function activity()
	{
		return $this->morphTo();
	}
}
