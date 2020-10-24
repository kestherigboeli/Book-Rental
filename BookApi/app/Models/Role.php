<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	/**
	 * Get the post that owns the comment.
	 */
	public function user()
	{
		return $this->hasMany(User::class);
	}
}
