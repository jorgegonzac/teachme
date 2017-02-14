<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'is_valid', 'question_id'
    ];

	/**
	 * Returns the owner question
	 *
	 * @return Collection
	 */
	public function question()
	{
		return $this->belongsTo('App\Question');
	}
}
