<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tittle', 'description', 'lesson_id'
    ];

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
}
