<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
	use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'lesson_id'
    ];

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

	/**
	 * Returns all the associated questions
	 *
	 * @return Collection
	 */
	public function questions()
	{
		return $this->hasMany('App\Question');
	}

	/**
	 * Returns the owner lesson
	 *
	 * @return Collection
	 */
	public function lesson()
	{
		return $this->belongsTo('App\Lesson');
	}

	/**
	 * Returns all the associated users
	 *
	 * @return Collection
	 */
	public function users()
	{
		return $this->belongsToMany('App\User', 'user_test')->withTimestamps()->withPivot('score', 'completed');
	}
}
