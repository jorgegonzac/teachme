<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tittle', 'description', 'content_url', 'start_date', 'end_date',
    ];

	/**
	 * Returns all the associated tests
	 *
	 * @return Collection
	 */
	public function tests()
	{
		return $this->hasMany('App\Test');
	}

	/**
	 * Returns the associated users
	 *
	 * @return Collection
	 */
	public function users()
	{
		return $this->belongsToMany('App\User', 'user_lesson')->withPivot('completed')->withTimestamps();
	}
}
