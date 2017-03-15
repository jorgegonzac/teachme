<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
	/**
	 * Table name
	 *
	 * @var string
	 */
    protected $table = 'user_invitations';

	/**
	 * Attributes that are mass asignable
	 * @var [type]
	 */
	protected $fillable = ['email', 'token'];
}
