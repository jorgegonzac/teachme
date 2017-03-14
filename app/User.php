<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'profile_img', 'progress_course'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
	 * Returns the associated lessons
	 *
	 * @return Collection
	 */
	public function lessons()
	{
		return $this->belongsToMany('App\Lesson', 'user_lesson')->withPivot('score', 'completed')->withTimestamps();
	}

	/**
	 * Returns the associated tests
	 *
	 * @return Collection
	 */
	public function tests()
	{
		return $this->belongsToMany('App\Test')->withTimestamps();
	}
}
