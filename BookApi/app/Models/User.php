<?php

namespace App;

use App\Models\Activity;
use App\Models\Schedule;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Cashier\Billable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded =[];

	public function getRouteKeyName()
	{
		return 'user_id';
	}

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


	/**
	 * Hash password when storing in the database
	 *
	 * @var string
	 */
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);
	}

	// Rest omitted for brevity

	/**
	 * Get the identifier that will be stored in the subject claim of the JWT.
	 *
	 * @return mixed
	 */
	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Return a key value array, containing any custom claims to be added to the JWT.
	 *
	 * @return array
	 */
	public function getJWTCustomClaims()
	{
		return [];
	}


	/**
	 * Get the Roles for the User.
	 */
	public function role()
	{
		return $this->belongsTo(Role::class);
	}

	/**
	 * Get all of the video where watched is true.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function activities()
	{
		return $this->hasMany(Activity::class, 'user_id');
	}

	/**
	 * Send the email verification notification.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function activity()
	{
		return $this->morphMany(Activity::class, "activity");
	}

	public function bookings()
	{
		return $this->hasMany(Booking::class);
	}

	public function schedules()
	{
		return $this->hasMany(Schedule::class);
	}
}
