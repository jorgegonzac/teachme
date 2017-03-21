<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
	use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'content_url', 'start_date', 'end_date',
    ];

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
