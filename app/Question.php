<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'test_id'
    ];

	/**
	 * Returns all the associated Answers
	 *
	 * @return Collection
	 */
	public function answers()
	{
		return $this->hasMany('App\Answer');
	}

	/**
	 * Returns the owner test
	 *
	 * @return Collection
	 */
	public function test()
	{
		return $this->belongsTo('App\Test');
	}
}
